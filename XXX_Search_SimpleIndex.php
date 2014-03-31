<?php

/*

Cache parsed information
From the search perspective?


collapse spacing into 1

result presentation:
	source (Default)
	query

comparison:
	- literal
	- simplified characters (without accents lower case etc.) (Default)
	
term modes:
	- full
	- split

highlighting:
	- <b> Identical from beginning
	- <u> Identical anywhere within
	- <i> Similar from beginning
	- <i> Similar anwywhere within

precedence:
	- full
		- Identical from beginning
		- Identical anywhere within
		- Similar from beginning
		- Similar anywhere within
	- split
		- Identical from beginning
		- Identical anywhere within
		- Similar from beginning
		- Similar anywhere within

problems:
	- matching (character switches) and result presentation difference
	- if special character is simplified to multiple base characters, how to highlight/match
		Dußeldorf -> Dusseldorf
		
		Duß has to highlight Duss as <b></b> and reversed
	
		Have a switchboard for from>to
			If ss -> ß, there should be a mapping for both s'es back to the single character
			
			source (Dußeldorf)
			comparisonSource (dusseldorf)
			
		Loop torugh each character
			- have an original switchboard
			- have a normalized switchboard
				- original character index
				- normalized characters
			
			get position of match
				
				loop from there for the original start, to original end

*/	

class XXX_Search_SimpleIndex
{
	public $termMode = 'split';
	public $characterMatchingMode = 'simplified';
	
	public $dataType = '';
	
	public $hasData = false;
	
	public $sourceValues = array();
	public $sourceValueInformations = array();
	public $sourceDatas = array();
	
	public $sourceMatchers = array();
	
	public $labels = array();
	
	public $query = false;
	public $queryValueInformation = false; 
	
	public function __construct ($termMode, $characterMatchingMode, $dataType)
	{
		$this->termMode = XXX_Default::toOption($termMode, array('full', 'split'), 'split');
		$this->characterMatchingMode = XXX_Default::toOption($characterMatchingMode, array('raw', 'simplified'), 'simplified');
		
		$this->dataType = $dataType;
	}
	
	public function addSource ($source)
	{
		$sourceValue = '';
	
		if (XXX_Type::isArray($source))
		{
			$sourceValue = $source['value'];
			
			$this->hasData = true;
		}
		else
		{
			$sourceValue = $source;
		}
		
		$sourceValueInformation = XXX_String_Search::composeValueInformation($sourceValue, $this->termMode, $this->characterMatchingMode);
		
		$index = XXX_Array::getFirstLevelItemTotal($this->sourceValueInformations);
		
		$this->sourceValues[] = $sourceValue;
		$this->sourceValueInformations[] = $sourceValueInformation;
		
		if ($this->hasData)
		{
			$this->sourceDatas[] = $source;
		}
		
		return $index;
	}
	
	public function addSources ($sources)
	{
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($sources); $i < $iEnd; ++$i)
		{
			$this->addSource($sources[$i]);
		}
	}
	
	
	public function executeQuery ($query)
	{
		$this->query = $query;
		$this->queryValueInformation = XXX_String_Search::composeValueInformation($query, $this->termMode, $this->characterMatchingMode);
	
		$this->sourceMatchers = array();
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($this->sourceValueInformations); $i < $iEnd; ++$i)
		{
			$index = $i;
			$sourceValueInformation = $this->sourceValueInformations[$i];
			
			$sourceMatcher = XXX_String_Search::composeMatcher($index, $sourceValueInformation, $this->termMode, $this->characterMatchingMode);
			
			$sourceMatcher = XXX_String_Search::processSourceWithQueryInMatcher($sourceValueInformation, $this->queryValueInformation, $sourceMatcher, $this->termMode, $this->characterMatchingMode);
			
			if ($sourceMatcher)
			{
				$this->sourceMatchers[] = $sourceMatcher;
			}
		}
		
		
		usort($this->sourceMatchers, 'XXX_Search_SimpleIndex::compareSourceMatchers');
		
		//XXX_Type::peakAtVariable($this->sourceValueInformations);
		//XXX_Type::peakAtVariable($this->sourceMatchers);
	}
	
	public static function compareSourceMatchers ($a, $b)
	{
		return XXX_String_Search::compareMatchers($a, $b);
	}
	
	
	public function getSuggestions ()
	{
		$suggestions = array();
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($this->sourceMatchers); $i < $iEnd; ++$i)
		{
			$sourceMatcher = $this->sourceMatchers[$i];
			$sourceValue = $this->sourceValues[$sourceMatcher['sourceIndex']];
			$sourceValueInformation = $this->sourceValueInformations[$sourceMatcher['sourceIndex']];
			if ($this->hasData)
			{
				$sourceData = $this->sourceDatas[$sourceMatcher['sourceIndex']];
			}
			
			$label = XXX_String_Search::composeLabelFromSourceValueInformationAndSourceMatcher($sourceValueInformation, $sourceMatcher, $this->termMode, $this->characterMatchingMode);
			
			$suggestion = array
			(
				'valueAskingSuggestions' => $this->query,
				'suggestedValue' => $sourceValue,
				'complement' => '',
				'label' => $label,
				'data' => array()
			);
			
			if ($this->hasData)
			{
				$suggestion['data'] = $sourceData;
			}
			
			if ($this->dataType != '' && XXX_Type::isEmpty($suggestion['data']['dataType']))
			{
				$suggestion['data']['dataType'] = $this->dataType;
			}
			
			$suggestions[] = $suggestion;
		}
		
		return $suggestions;
	}
	
	public function getSuggestionProviderSourceResponse ()
	{
		$result = array
		(
			'type' => 'processed',
			'valueAskingSuggestions' => $this->query,
			'suggestions' => $this->getSuggestions()
		);
		
		return $result;
	}
	
	
	public function composeLabels ()
	{
		$output = '';
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($this->sourceMatchers); $i < $iEnd; ++$i)
		{
			$sourceMatcher = $this->sourceMatchers[$i];
			$sourceValueInformation = $this->sourceValueInformations[$sourceMatcher['sourceIndex']];
			
			$label = XXX_String_Search::composeLabelFromSourceValueInformationAndSourceMatcher($sourceValueInformation, $sourceMatcher, $this->termMode, $this->characterMatchingMode);
			
			$output .= '<br>' . $label . '<br>';
		}
		
		return $output;
	}
	
}



?>
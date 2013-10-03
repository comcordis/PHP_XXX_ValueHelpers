<?php

/*

Messy sample data:
browserName, browserAlias, 5446.545e12
"Inter,net \"Explorer", Something,564458
5ED38874.cm-7-4c.dynamic.ziggo.nl,94.211.136.116
host,ip
   work.com   ,,hjhjk,
home.net,, -5667567 ,
123, someOtherValue
  1234e-10, someOtherValue
, (Empty)
"Hello", someOtherValue
"Hello there", someOtherValue
"Hello \" a\nd, so there" , someOtherValue
'Hello', someOtherValue
'Hello there', someOtherValue
'Hello \' and, so there' ,  someOtherValue
Hello,  someOtherValue
Hello there, someOtherValue


Delimiter: , or ;
Enclosure: ' "
Escape \' \"

*/

abstract class XXX_String_CSV
{
	const CLASS_NAME = 'XXX_String_CSV';
	
	public static function compose ($array, $glue = ',', $useCommaForNumbers = false)
	{
		$result = false;
		
		$rowTotal = XXX_Array::getFirstLevelItemTotal($array);
		
		if ($rowTotal > 0 && XXX_Array::getDeepestLevel($array) == 2)
		{
			$columnTotal = XXX_Array::getFirstLevelItemTotal($array[0]);
			
			$result = '';
			
			for ($i = 0, $iEnd = $rowTotal; $i < $iEnd; ++$i)
			{
				for ($j = 0, $jEnd = $columnTotal; $j < $jEnd; ++$j)
				{
					$value = $array[$i][$j];
					
					if ($j > 0)
					{
						$result .= $glue;
					}
					
					if (XXX_Type::isString($value) && XXX_String::findFirstPosition($value, ' ') !== false)
					{
						$result .= '"' . XXX_String::addSlashes($value) . '"';
					}
					else if (XXX_Type::isBoolean($value))
					{
						$result .= $value ? 'true' : 'false';
					}
					else
					{
						if ($useCommaForNumbers)
						{
							$result .= XXX_String::replace($value, '.', ',');
						}
						else
						{
							$result .= $value;
						}
					}					
				}
				
				$result .= XXX_String::$lineSeparator;
			}
		}
		else
		{
			// Array should have rows and be 2 levels deep [row][column]
		}
		
		return $result;
	}
	
	public static function parse ($raw, $separator = ',')
	{
		$raw = XXX_String::normalizeLineSeparators($raw);
		
		$lines = XXX_String::splitToArray($raw, XXX_String::$lineSeparator);
		
		$parsedLines = self::parseLines($lines, $separator);
		
		$parsedLines = self::balanceColumns($parsedLines);
		
		return $parsedLines;
	}
	
	public static function parseLines ($lines, $separator = ',')
	{
		$parsedLines = array();
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($lines); $i < $iEnd; ++$i)
		{
			if ($lines[$i] != '')
			{
				$parsedLines[$i] = self::parseLine($lines[$i], $separator);
			}
		}
		
		return $parsedLines;
	}
	
	public static function parseLine ($line = '', $separator = ',')
	{
		$matches = XXX_String_Pattern::getMatches($line, '(?<=^|' . $separator . ')(?:\\s*(?:"((?:[^\\\\"]|\\\\"|\\\\)*)"|\'((?:[^\\\\"]|\\\\\'|\\\\)*)\'|(-?[0-9]+(?:\\.[0-9]+)?(?:[eE][-+]?[0-9]+)?)|([^' . $separator . ']+)|)\\s*)(?=$|' . $separator . ')', 'imu');
		
    	$matchesTotal = XXX_Array::getFirstLevelItemTotal($matches[0]);
    	
    	$parsedLine = array();
    	
    	for ($j = 0, $jEnd = $matchesTotal; $j < $jEnd; ++$j)
    	{
    		$value = null;
    		
    		if (XXX_String::trim($matches[1][$j]) != '')
    		{
    			$value = XXX_String::removeSlashes(XXX_String::trim($matches[1][$j]));
    		}
    		else if (XXX_String::trim($matches[2][$j]) != '')
    		{
    			$value = XXX_String::removeSlashes(XXX_String::trim($matches[2][$j]));
    		}
    		else if (XXX_String::trim($matches[3][$j]) != '')
    		{
    			$value = XXX_Type::makeNumber(XXX_String::trim($matches[3][$j]));
    		}
    		else if (XXX_String::trim($matches[4][$j]) != '')
    		{
    			$value = XXX_String::removeSlashes(XXX_String::trim($matches[4][$j]));
    		}
    		
    		$parsedLine[] = $value;
    	}
    			
    	return $parsedLine;
	}
	
	public static function balanceColumns ($parsedLines, $balanceValue = false)
	{
		$columns = 0;
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($parsedLines); $i < $iEnd; ++$i)
	    {
	    	$temp = XXX_Array::getFirstLevelItemTotal($parsedLines[$i]);
	    	
	    	if ($temp > $columns)
	    	{
	    		$columns = $temp;
	    	}
	    }
		
		
		// Balance columns
	    for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($parsedLines); $i < $iEnd; ++$i)
	    {
	    	for ($j = 0, $jEnd = $columns; $j < $jEnd; ++$j)
	    	{
	    		if (!isset($parsedLines[$i][$j]))
	    		{
	    			$parsedLines[$i][$j] = $balanceValue;
	    		}
	    	}
	    }
	    
	    return $parsedLines;
	}
}

?>
<?php

abstract class XXX_String_Search
{
	public static $separatorPattern = array('\\s*[,\\-()\\s/]\\s*', 'm');
	
	////////////////////
	// Terms (Split by , ( ) or space)
	////////////////////
	
	public static function splitToTerms ($sentence, $sorted)
	{
		$sentence = XXX_Type::makeString($sentence);
		
		$terms = XXX_String_Pattern::splitToArray($sentence, self::$separatorPattern[0], self::$separatorPattern[1]);
		
		$terms = XXX_Array::filterOutEmpty($terms);
		
		if ($sorted)
		{
			// From longest to shortest
			
			usort($terms, 'XXX_String_Search::compareTerms');
		}
		
		return $terms;
	}
	
	// From longest to shortest
	public static function compareTerms ($a, $b)
	{
		return XXX_String::getCharacterLength($b) - XXX_String::getCharacterLength($a);
	}
	
	public static function getRawParts ($value)
	{
		$matches = XXX_String_Pattern::getMatches($value, '(.*?)(' . self::$separatorPattern[0] . ')|(.+)', self::$separatorPattern[1]);
		
		$result = array();
		
		$offset = 0;
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($matches[0]); $i < $iEnd; ++$i)
		{
			for ($j = 1, $jEnd = 4; $j < $jEnd; ++$j)
			{
				if (XXX_Type::isValue($matches[$j][$i]) && $matches[$j][$i] !== '')
				{
					$characterLength = XXX_String::getCharacterLength($matches[$j][$i]);
					
					$result[] = array
					(
						'offset' => $offset,
						'characterLength' => $characterLength,
						'value' => $matches[$j][$i],
						'partType' => ($j == 2) ? 'separator' : 'term'
					);
					
					$offset += $characterLength;
				}
			}
		}
		
		return $result;
	}
	
	public static function composeValueInformationSub ($value, $characterMatchingMode)
	{
		$result = array();
		
		$result['rawValue'] = $value;
		$result['rawCharacterLength'] = XXX_String::getCharacterLength($value);
		
		if ($characterMatchingMode == 'simplified')
		{
			$result['simplifiedValue'] = '';
			$result['simplifiedCharacterLength'] = 0;
			
			$result['simplifiedToRawMapping'] = array();
			
			for ($i = 0, $iEnd = $result['rawCharacterLength']; $i < $iEnd; ++$i)
			{
				$rawCharacter = XXX_String::getPart($result['rawValue'], $i, 1);
				
				$simplifiedCharacter = XXX_String::simplifyCharacters($rawCharacter);
				$simplifiedCharacterCharacterLength = XXX_String::getCharacterLength($simplifiedCharacter);
				
				if ($simplifiedCharacterCharacterLength > 1)
				{
					for ($j = 0, $jEnd = $simplifiedCharacterCharacterLength; $j < $jEnd; ++$j)
					{
						$result['simplifiedValue'] .= XXX_String::getPart($simplifiedCharacter, $j, 1);
						
						$result['simplifiedToRawMapping'][] = $i;
						
						++$result['simplifiedCharacterLength'];
					}
				}
				else
				{
					$result['simplifiedValue'] .= $simplifiedCharacter;
					
					$result['simplifiedToRawMapping'][] = $i;
					
					++$result['simplifiedCharacterLength'];
				}
			}
		}
		
		return $result;
	}
	
	public static function composeValueInformation ($value, $termMode, $characterMatchingMode)
	{
		$result = false;
		
		switch ($termMode)
		{
			case 'split':
				$parts = self::getRawParts($value);
				
				$newParts = array();
				
				for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($parts); $i < $iEnd; ++$i)
				{
					$part = $parts[$i];
				
					$newPart = false;
					
					switch ($part['partType'])
					{
						case 'separator':
							$newPart = self::composeValueInformationSub($part['value']);
							break;
						case 'term':
							$newPart = self::composeValueInformationSub($part['value'], $characterMatchingMode);
							break;
					}
					
					$newPart['partType'] = $part['partType'];
					$newParts[] = $newPart;
				}
				
				$result = $newParts;
				break;
			case 'full':
			default:
				$result = self::composeValueInformationSub($value, $characterMatchingMode);
				break;
		}
		
		return $result;
	}
		
	public static function composeMatcher ($sourceIndex, $valueInformation, $termMode, $characterMatchingMode)
	{
		$result = array();
		
		$result['sourceIndex'] = $sourceIndex;
		$result['bestMatchType'] = false;
		$result['identicalCharacterHitTotal'] = 0;
		$result['similarCharacterHitTotal'] = 0;
		$result['levenshteinDistanceTotal'] = 0;
		$result['termHitTotal'] = 0;
		
		$result['lowestMatchOffset'] = 10000;
		
		$result['characterLength'] = 0;
				
		switch ($termMode)
		{
			case 'split':
				$result['parts'] = array();
				
				for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($valueInformation); $i < $iEnd; ++$i)
				{
					$valueInformationSub = $valueInformation[$i];
				
					$matcherPart = array();
					$matcherPart['partType'] = $valueInformationSub['partType'];
					
					$matcherPart['rawCharacterLength'] = $valueInformationSub['rawCharacterLength'];
					
					if ($characterMatchingMode == 'simplified')
					{
						$matcherPart['simplifiedCharacterLength'] = $valueInformationSub['simplifiedCharacterLength'];
					}
					
					$result['characterLength'] += $valueInformationSub['rawCharacterLength'];
					
					switch ($matcherPart['partType'])
					{
						case 'separator':
							break;
						case 'term':
							
							$matcherPart['rawCharacterHits'] = array();
				
							for ($j = 0, $jEnd = $matcherPart['rawCharacterLength']; $j < $jEnd; ++$j)
							{
								$matcherPart['rawCharacterHits'][] = false;
							}
							
							if ($characterMatchingMode == 'simplified')
							{
								$matcherPart['simplifiedCharacterHits'] = array();
								
								for ($j = 0, $jEnd = $matcherPart['simplifiedCharacterLength']; $j < $jEnd; ++$j)
								{
									$matcherPart['simplifiedCharacterHits'][] = false;
								}
							}
							break;
					}
					
					$result['parts'][] = $matcherPart;
				}
				break;
			case 'full':
			default:
				$result['characterLength'] = $valueInformation['rawCharacterLength'];
				
				$result['rawCharacterLength'] = $valueInformation['rawCharacterLength'];
				
				$result['rawCharacterHits'] = array();
				
				for ($i = 0, $iEnd = $result['rawCharacterLength']; $i < $iEnd; ++$i)
				{
					$result['rawCharacterHits'][] = false;
				}
				
				if ($characterMatchingMode == 'simplified')
				{
					$result['simplifiedCharacterLength'] = $valueInformation['simplifiedCharacterLength'];
					
					$result['simplifiedCharacterHits'] = array();
					
					for ($i = 0, $iEnd = $result['simplifiedCharacterLength']; $i < $iEnd; ++$i)
					{
						$result['simplifiedCharacterHits'][] = false;
					}
				}
				break;
		}
		
		return $result;
	}
	
		public static function getMatcherSortNumber ($matcher)
		{
			$result = 0;
			
			if (!XXX_Type::isAssociativeArray($matcher))
			{
				$result = 1;
			}
			
			return $result;
		}
		
		public static function getTermModeSortNumber ($termMode)
		{
			$result = 0;
			
			switch ($termMode)
			{
				case 'full':
					$result = 1;
					break;
				case 'split':
					$result = 2;
					break;
				case false:
				default:
					$result = 3;
					break;
			}
			
			return $result;
		}
		
		public static function getMatchTypeSortNumber ($matchType)
		{
			$result = 0;
			
			switch ($matchType)
			{
				case 'identical':
					$result = 1;
					break;
				case 'similar':
					$result = 2;
					break;
				case false:
				default:
					$result = 3;
					break;
			}
			
			return $result;
		}
			
	public static function compareMatchers ($a, $b)
	{
		$result = 0;
		
		$result = self::getMatcherSortNumber($a) - self::getMatcherSortNumber($b);
		
		if ($result == 0)
		{
			$result = self::getMatchTypeSortNumber($a['bestMatchType']) - self::getMatchTypeSortNumber($b['bestMatchType']);
			/*
			if ($result == 0)
			{
				$result = self::getTermModeSortNumber($a['termMode']) - self::getTermModeSortNumber($b['termMode']);
			*/
				if ($result == 0)
				{
					$result = $b['termHitTotal'] - $a['termHitTotal'];
					
					if ($result == 0)
					{
						$result = ($b['identicalCharacterHitTotal'] + $b['similarCharacterHitTotal']) - ($a['identicalCharacterHitTotal'] + $a['identicalCharacterHitTotal']);
												
						if ($result == 0)
						{						
							$result = $b['identicalCharacterHitTotal'] - $a['identicalCharacterHitTotal'];
													
							if ($result == 0)
							{
								$result = $b['similarCharacterHitTotal'] - $a['similarCharacterHitTotal'];
								
								if ($result == 0)
								{
									$result = $a['levenshteinDistanceTotal'] - $b['levenshteinDistanceTotal'];
									
									if ($result == 0)
									{
										$result = $a['characterLength'] - $b['characterLength'];
										
										if ($result == 0)
										{
											$result = $a['lowestMatchOffset'] - $b['lowestMatchOffset'];
										}
									}
								}
							}
						}
					}
				}
			//}
		}
		
		return $result;
	}
	
	public static function isBetterMatchType ($oldMatchType, $newMatchType)
	{
		$result = false;
		
		switch ($oldMatchType)
		{
			case 'identical':											
				break;
			case 'similar':
				if ($newMatchType == 'identical')
				{
					$result = true;
				}
				break;
			case false:
				$result = true;
				break;
		}
		
		return $result;
	}
	
	public static function applyCharacterHitsToMatcher ($matcher, $valueInformationSub, $characterMatchingMode, $matchType, $matchOffset, $matchCharacterLength)
	{
		for ($i = $matchOffset, $iEnd = $matchOffset + $matchCharacterLength; $i < $iEnd; ++$i)
		{
			switch ($characterMatchingMode)
			{
				case 'raw':
					if (self::isBetterMatchType($matcher['rawCharacterHits'][$i], $matchType))
					{
						$matcher['rawCharacterHits'][$i] = $matchType;
					}
					break;
				case 'simplified':
						if (self::isBetterMatchType($matcher['simplifiedCharacterHits'][$i], $matchType))
						{
							$matcher['simplifiedCharacterHits'][$i] = $matchType;
						}
					
						$rawCharacterIndex = $valueInformationSub['simplifiedToRawMapping'][$i];
						
						if (self::isBetterMatchType($matcher['rawCharacterHits'][$rawCharacterIndex], $matchType))
						{
							$matcher['rawCharacterHits'][$rawCharacterIndex] = $matchType;
						}
					break;
			}
		}
		
		return $matcher;
	}
	
	public static function getMaximumLevenshteinDistanceForCharacterLength ($characterLength)
	{
		$result = 0;
		
		if ($characterLength > 2)
		{
			$result = XXX_Number::floor($characterLength * 0.4);
			
			$result = XXX_Number::lowest($result, 3);
		}
		
		return $result;
	}
	
	public static function compareTemporarySimilarMatches ($a, $b)
	{
		$result = 0;
		
		$result = $a[0] - $b[0];
		
		if ($result == 0)
		{		
			$result = $a[2] - $b[2];
			
			if ($result == 0)
			{
				$result = $a[1] - $b[1];
			}
		}
		
		return $result;
	}
	
	public static function getMatchInformation ($source, $query, $sourceCharacterLength, $queryCharacterLength, $similarWithinWord)
	{
		if (!$sourceCharacterLength)
		{
			$sourceCharacterLength = XXX_String::getCharacterLength($source);
		}
		
		if (!$queryCharacterLength)
		{
			$queryCharacterLength = XXX_String::getCharacterLength($query);
		}
			
		$result = false;
		
		$matchType = false;
		$matchOffset = 0;
		$matchCharacterLength = 0;
		$matchLevenshteinDistance = 0;
		
		$matchAtCharacterPosition = XXX_String::findFirstPosition($source, $query);
				
		if ($matchAtCharacterPosition !== false)
		{
			$matchType = 'identical';
			$matchOffset = $matchAtCharacterPosition;
			$matchCharacterLength = $queryCharacterLength;
		}
		else
		{
			if ($queryCharacterLength > 2)
			{
				$maximumLevenshteinDistance = self::getMaximumLevenshteinDistanceForCharacterLength($queryCharacterLength);
				
				if ($maximumLevenshteinDistance > 0)
				{
					if ($queryCharacterLength < $sourceCharacterLength)
					{
						$characterLengthDifference = $sourceCharacterLength - $queryCharacterLength;
						
						$maximumOffset = $characterLengthDifference;
						
						if (!$similarWithinWord)
						{
							$maximumOffset = 1;
						}
						
						$temporarySimilarMatches = array();
							
						for ($i = 0, $iEnd = $maximumOffset; $i < $iEnd; ++$i)
						{
							$sourcePart = XXX_String::getPart($source, $i, $queryCharacterLength);
							
							$levenshteinDistance = XXX_String_Levenshtein::getDistance($query, $sourcePart);
							
							if ($levenshteinDistance <= $maximumLevenshteinDistance)
							{
								$expandingOffset = $i;
								$expandingLevenshteinDistance = $levenshteinDistance;
								$expandingCharacterLength = $queryCharacterLength;
								
								$extraExpandingCharacterLength = $characterLengthDifference - $i;
								
								if ($extraExpandingCharacterLength > 0)
								{
									for ($j = $queryCharacterLength + 1, $jEnd = $queryCharacterLength + $extraExpandingCharacterLength; $j <= $jEnd; ++$j)
									{
										$sourcePartSub = XXX_String::getPart($source, $i, $j);
										
										$levenshteinDistanceSub = XXX_String_Levenshtein::getDistance($query, $sourcePartSub);
										
										if ($levenshteinDistanceSub <= $expandingLevenshteinDistance)
										{
											$expandingLevenshteinDistance = $levenshteinDistanceSub;
											$expandingCharacterLength = $j;
										}
										else
										{
											break;
										}
									}
									
									$temporarySimilarMatches[] = array($expandingOffset, $expandingLevenshteinDistance, $expandingCharacterLength);
								}
								else
								{
									$temporarySimilarMatches[] = array($i, $levenshteinDistance, $queryCharacterLength);
								}
							}
						}
						
						if (XXX_Array::getFirstLevelItemTotal($temporarySimilarMatches))
						{
							usort($temporarySimilarMatches, 'XXX_String_Search::compareTemporarySimilarMatches');
							
							$tempOffset = $temporarySimilarMatches[0][0];
							$tempDistance = $temporarySimilarMatches[0][1];
							$tempCharacterLength = $temporarySimilarMatches[0][2];
							
							$matchType = 'similar';
							$matchOffset = $tempOffset;
							$matchCharacterLength = $tempCharacterLength;
							$matchLevenshteinDistance = $tempDistance;
						}
					}
					else
					{
						$sourceIsLongEnough = true;
						
						if ($queryCharacterLength > $sourceCharacterLength)
						{
							$minimumCharacterLength = XXX_Number::highest($queryCharacterLength - $maximumLevenshteinDistance, 0);
							
							if ($sourceCharacterLength < $minimumCharacterLength)
							{
								$sourceIsLongEnough = false;
							}
						}
						
						if ($sourceIsLongEnough)
						{
							$levenshteinDistance = XXX_String_Levenshtein::getDistance($source, $query);
							
							if ($levenshteinDistance <= $maximumLevenshteinDistance)
							{
								$matchType = 'similar';
								$matchCharacterLength = $queryCharacterLength;						
								$matchLevenshteinDistance = $levenshteinDistance;
							}
						}
					}
				}
			}
		}
		
		if ($matchType !== false)
		{
			$result = array
			(
				'matchType' => $matchType,
				'matchOffset' => $matchOffset,
				'matchCharacterLength' => $matchCharacterLength,
				'matchLevenshteinDistance' => $matchLevenshteinDistance
			);
		}
		
		return $result;
	}
	
	public static function processSourceWithQueryInMatcher ($sourceValueInformation, $queryValueInformation, $matcher, $termMode, $characterMatchingMode)
	{
		$result = false;
		
		$sourceValue = '';
		$sourceCharacterLength = 0;
		
		$queryValue = '';
		$queryCharacterLength = 0;
		
		switch ($termMode)
		{
			case 'full':
				
				switch ($characterMatchingMode)
				{
					case 'raw':
						$sourceValue = $sourceValueInformation['rawValue'];
						$sourceCharacterLength = $sourceValueInformation['rawCharacterLength'];
						
						$queryValue = $queryValueInformation['rawValue'];
						$queryCharacterLength = $queryValueInformation['rawCharacterLength'];
						break;
					case 'simplified':
						$sourceValue = $sourceValueInformation['simplifiedValue'];
						$sourceCharacterLength = $sourceValueInformation['simplifiedCharacterLength'];
						
						$queryValue = $queryValueInformation['simplifiedValue'];
						$queryCharacterLength = $queryValueInformation['simplifiedCharacterLength'];
						break;
				}
				
				$matchInformation = self::getMatchInformation($sourceValue, $queryValue, $sourceCharacterLength, $queryCharacterLength);
			
				if ($matchInformation !== false)
				{				
					$matcher = self::applyCharacterHitsToMatcher($matcher, $sourceValueInformation, $characterMatchingMode, $matchInformation['matchType'], $matchInformation['matchOffset'], $matchInformation['matchCharacterLength']);
					
					if (self::isBetterMatchType($matcher['bestMatchType'], $matchInformation['matchType']))
					{
						$matcher['bestMatchType'] = $matchInformation['matchType'];
					}
					
					switch ($matchInformation['matchType'])
					{
						case 'identical':
							$matcher['identicalCharacterHitTotal'] = $matchInformation['matchCharacterLength'];
							break;
						case 'similar':
							$matcher['similarCharacterHitTotal'] = $matchInformation['matchCharacterLength'];
							$matcher['levenshteinDistanceTotal'] = $matchInformation['matchLevenshteinDistance'];
							break;
					}
					
					$matcher['termHitTotal'] = 1;
				
					if ($matchInformation['matchOffset'] < $matcher['lowestMatchOffset'])
					{
						$matcher['lowestMatchOffset'] = $matchInformation['matchOffset'];
					}
					
					$result = $matcher;
				}
				 
				break;
			case 'split':
				
				$hasMatch = false;
				
				$previousPartsOffset = 0;
				
				for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($sourceValueInformation); $i < $iEnd; ++$i)
				{
					$sourceValueInformationPart = $sourceValueInformation[$i];
					
					$matcherPart = $matcher['parts'][$i];
					
					switch ($characterMatchingMode)
					{
						case 'raw':
							$sourceValue = $sourceValueInformationPart['rawValue'];
							$sourceCharacterLength = $sourceValueInformationPart['rawCharacterLength'];
							break;
						case 'simplified':
							$sourceValue = $sourceValueInformationPart['simplifiedValue'];
							$sourceCharacterLength = $sourceValueInformationPart['simplifiedCharacterLength'];
							break;
					}
					
					switch ($sourceValueInformationPart['partType'])
					{
						case 'separator':
							// TODO count offset etc.
							break;
						case 'term':							
							for ($j = 0, $jEnd = XXX_Array::getFirstLevelItemTotal($queryValueInformation); $j < $jEnd; ++$j)
							{
								$queryValueInformationPart = $queryValueInformation[$j];
								
								if ($queryValueInformationPart['partType'] == 'term')
								{
									switch ($characterMatchingMode)
									{
										case 'raw':
											$queryValue = $queryValueInformationPart['rawValue'];
											$queryCharacterLength = $queryValueInformationPart['rawCharacterLength'];
											break;
										case 'simplified':
											$queryValue = $queryValueInformationPart['simplifiedValue'];
											$queryCharacterLength = $queryValueInformationPart['simplifiedCharacterLength'];
											break;
									}
									
									$matchInformation = self::getMatchInformation($sourceValue, $queryValue, $sourceCharacterLength, $queryCharacterLength);
								
									if ($matchInformation !== false)
									{
										$hasMatch = true;
										
										$matcherPart = self::applyCharacterHitsToMatcher($matcherPart, $sourceValueInformationPart, $characterMatchingMode, $matchInformation['matchType'], $matchInformation['matchOffset'], $matchInformation['matchCharacterLength']);
										
										if (self::isBetterMatchType($matcher['bestMatchType'], $matchInformation['matchType']))
										{
											$matcher['bestMatchType'] = $matchInformation['matchType'];
										}
										
										switch ($matchInformation['matchType'])
										{
											case 'identical':
												$matcher['identicalCharacterHitTotal'] += $matchInformation['matchCharacterLength'];
												break;
											case 'similar':
												$matcher['similarCharacterHitTotal'] += $matchInformation['matchCharacterLength'];
												$matcher['levenshteinDistanceTotal'] += $matchInformation['matchLevenshteinDistance'];
												break;
										}
										
										$matcher['termHitTotal'] += 1;
										
										$correctedMatchOffset = $previousPartsOffset + $matchInformation['matchOffset'];
										
										if ($correctedMatchOffset < $matcher['lowestMatchOffset'])
										{
											$matcher['lowestMatchOffset'] = $correctedMatchOffset;
										}
									}
								}
							}
							break;
					}
					
					$matcher['parts'][$i] = $matcherPart;
					
					$previousPartsOffset += $sourceValueInformationPart['rawCharacterLength'];
				}
				
				if ($hasMatch)
				{
					$result = $matcher;
				}
				break;
		}
		
		return $result;
	}
	
	public static function composeLabelFromSourceValueInformationAndSourceMatcher ($sourceValueInformation, $sourceMatcher, $termMode, $characterMatchingMode)
	{
		$result = '';
		
		/*
		$result .= $sourceMatcher['bestMatchType'] . '|';
		$result .= $sourceMatcher['identicalCharacterHitTotal'] . '|';
		$result .= $sourceMatcher['similarCharacterHitTotal'] . '|';
		$result .= $sourceMatcher['levenshteinDistanceTotal'] . '|';
		$result .= $sourceMatcher['termHitTotal'] . '|';
		$result .= $sourceMatcher['lowestMatchOffset'] . '|';
		$result .= $sourceMatcher['characterLength'] . '|';
		*/
		
		$previousCharacterHit = false;
		$characterHit = false;
		$character = '';
		
		$value = '';
		$characterHits = array();
		
		switch ($termMode)
		{
			case 'full':
				switch ($characterMatchingMode)
				{
					case 'raw':
						$value = $sourceValueInformation['rawValue'];
						$characterHits = $sourceMatcher['rawCharacterHits'];
						break;
					case 'simplified':
						$value = $sourceValueInformation['rawValue'];
						$characterHits = $sourceMatcher['rawCharacterHits'];
						break;
				}
				
				for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($characterHits); $i < $iEnd; ++$i)
				{
					$characterHit = $characterHits[$i];
					
					if ($characterHit != $previousCharacterHit)
					{
						switch ($previousCharacterHit)
						{
							case 'identical':
								$result .= '</b>';
								break;
							case 'similar':
								$result .= '</u>';
								break;
						}
						
						switch ($characterHit)
						{
							case 'identical':
								$result .= '<b>';
								break;
							case 'similar':
								$result .= '<u>';
								break;
						}
					}
					
					$result .= XXX_String::getPart($value, $i, 1);
					
					$previousCharacterHit = $characterHit;
				}
				break;
			case 'split':
				for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($sourceValueInformation); $i < $iEnd; ++$i)
				{
					$sourceValueInformationPart = $sourceValueInformation[$i];
					
					$sourceMatcherPart = $sourceMatcher['parts'][$i];
					
					switch ($sourceValueInformationPart['partType'])
					{
						case 'separator':						
							switch ($previousCharacterHit)
							{
								case 'identical':
									$result .= '</b>';
									break;
								case 'similar':
									$result .= '</u>';
									break;
							}
							
							$result .= $sourceValueInformationPart['rawValue'];
							
							$previousCharacterHit = false;
							break;
						case 'term':
							
							switch ($characterMatchingMode)
							{
								case 'raw':
									$value = $sourceValueInformationPart['rawValue'];
									$characterHits = $sourceMatcherPart['rawCharacterHits'];
									break;
								case 'simplified':
									$value = $sourceValueInformationPart['rawValue'];
									$characterHits = $sourceMatcherPart['rawCharacterHits'];
									break;
							}
							
							for ($j = 0, $jEnd = XXX_Array::getFirstLevelItemTotal($characterHits); $j < $jEnd; ++$j)
							{
								$characterHit = $characterHits[$j];
								
								if ($characterHit != $previousCharacterHit)
								{
									switch ($previousCharacterHit)
									{
										case 'identical':
											$result .= '</b>';
											break;
										case 'similar':
											$result .= '</u>';
											break;
									}
									
									switch ($characterHit)
									{
										case 'identical':
											$result .= '<b>';
											break;
										case 'similar':
											$result .= '<u>';
											break;
									}
								}
								
								$result .= XXX_String::getPart($value, $j, 1);
								
								$previousCharacterHit = $characterHit;
							}
							break;
					}
				}
				break;
		}
		
		switch ($previousCharacterHit)
		{
			case 'identical':
				$result .= '</b>';
				break;
			case 'similar':
				$result .= '</u>';
				break;
		}
		
		return $result;
	}
}

?>
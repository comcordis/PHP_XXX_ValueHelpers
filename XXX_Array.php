<?php

abstract class XXX_Array
{
	public static function createAssociativeArray ()
	{
		return array();
	}
	
	public static function createNumericArray ()
	{
		return array();
	}
	
	////////////////////
	// Value & key existance
	////////////////////
	
	public static function hasValue ($hayStack, $needle, $recursive = true, $strict = true)
	{
		$exists = false;
		
		if (XXX_Type::isArray($hayStack))
		{
			foreach ($hayStack as $possibleNeedle)
			{
				if (XXX_Type::isArray($possibleNeedle) && $recursive)
				{
					$exists = self::hasValue($possibleNeedle, $needle, $recursive, $strict);
				}
				else
				{
					$exists = ($strict) ? ($needle === $possibleNeedle) : ($needle == $possibleNeedle);
				}
				
				if ($exists)
				{
					break;
				}
			}
		}
		
		return $exists;
	}
	
	public static function hasKey ($hayStack, $needle, $recursive = true, $strict = true)
	{
		$exists = false;
		
		if (XXX_Type::isArray($hayStack))
		{
			foreach ($hayStack as $possibleNeedle => $value)
			{
				$exists = ($strict) ? ($needle === $possibleNeedle) : ($needle == $possibleNeedle);
				
				if (!$exists && $recursive)
				{			
					$exists = XXX_Type::isArray($value) ? self::hasKey($value, $needle, $recursive, $strict) : false;
				}
				
				if ($exists)
				{
					break;
				}
			}
		}
		
		return $exists;
	}
	
	
	////////////////////
	// Part
	////////////////////
	
	public static function getPart ($array = array(), $offset = 0, $length = 0)
	{
		$offset = XXX_Type::makeInteger($offset);
		$length = XXX_Type::makeInteger($length);
				
		if ($length === 0)
		{
			$length = self::getFirstLevelItemTotal($array);	
		}
		
		$result = array_slice($array, $offset, $length);
		
		return $result;
	}
	
	////////////////////
	// Matching
	////////////////////
	
	// Find a key (works only on root level)
	public static function getKeyForValue ($hayStack, $value, $strict = true)
	{
		$key = -1;
		
		foreach ($hayStack as $possibleKey => $possibleValue)
		{
			$exists = ($strict) ? ($value === $possibleValue) : ($value == $possibleValue);
						
			if ($exists)
			{				
				$key = $possibleKey;
				break;
			}
		}
		
		return $key;
	}
	
	public static function getKeys ($array)
	{
		$result = array();
		
		foreach ($array as $key => $value)
		{
			$result[] = $key;
		}
		
		return $result;
	}
	
	////////////////////
	// Merging
	////////////////////
	
	public static function merge ($array1, $array2, $strict = true)
	{
		foreach ($array2 as $key => $value)
		{
			// Key doesn't exist, so add it
			if (!self::hasKey($array1, $key, false, $strict))
			{
				$array1[$key] = $value;
			}
			// Key exists
			else
			{
				// If it is also an array, use recursion
				if (XXX_Type::isArray($value))
				{
					$array1[$key] = self::merge($array1[$key], $value);
				}
				// It's a non-array value, override it
				else
				{
					$array1[$key] = $value;
				}
			}
		}
		
		return $array1;
	}
		
	////////////////////
	// First level item total
	////////////////////
	
	public static function getFirstLevelItemTotal ($array)
	{
		return (isset($array) && $array !== false) ? count($array) : 0;	
	}
	
	////////////////////
	// Split
	////////////////////
	
	public static function splitOffLastItem ($array)
	{
		$lastItem = array_pop($array);
		
		$result = array
		(
			'lastItem' => $lastItem,
			'array' => $array
		);
		
		return $result;
	}
	
	public static function splitOffFirstItem ($array)
	{
		$firstItem = array_shift($array);
		
		$result = array
		(
			'firstItem' => $firstItem,
			'array' => $array
		);
		
		return $result;
	}
	
	public static function deleteFirstItem ($array)
	{
		array_shift($array);
		
		return $array;
	}
	
	public static function deleteLastItem ($array)
	{
		array_pop($array);
		
		return $array;
	}
	
	public static function getFirstValue ($array)
	{
		return $array[0];
	}
	
	public static function getLastValue ($array)
	{
		return $array[self::getFirstLevelItemTotal($array) - 1];
	}
	
	////////////////////
	// Deepest level
	////////////////////
	
	public static function getDeepestLevel ($array, $depthCount = -1)
	{
		$depthArray = array(0);
		++$depthCount;
		
		if (XXX_Type::isArray($array))
		{
			foreach ($array as $value)
			{
				$depthArray[] = self::getDeepestLevel($value, $depthCount);
			}
		}
		
		foreach ($depthArray as $value)
		{
			$depthCount = XXX_Number::highest($value, $depthCount);
		}
		
		return $depthCount;
	}
	
	////////////////////
	// Join
	////////////////////
	
	public static function joinValuesToString ($array, $glue)
	{
		return implode($glue, $array);	
	}
	
	////////////////////
	// Reverse
	////////////////////
	
	public static function reverse ($array)
	{
		return array_reverse($array);
	}
	
	////////////////////
	// Appending / Prepending values
	////////////////////
	
	public static function appendArray ($array, $array2)
	{
		if (XXX_Type::isFilledArray($array2))
		{
			for ($i = 0, $iEnd = self::getFirstLevelItemTotal($array2); $i < $iEnd; ++$i)
			{				
				$array[] = $array2[$i];	
			}
		}
		
		return $array;
	}
	
	public static function prependArray ($array, $array2)
	{
		if (XXX_Type::isFilledArray($array))
		{
			for ($i = 0, $iEnd = self::getFirstLevelItemTotal($array); $i < $iEnd; ++$i)
			{				
				$array2[] = $array[$i];	
			}
		}
		
		return $array2;
	}
	
	public static function appendValue ($array, $value)
	{
		return $array[] = value;
	}
	
	public static function prependValue ($array, $value)
	{
		return array_unshift($array, $value) ? 0 : false;
	}
	
	////////////////////
	// Sorting
	////////////////////
	
	public static function sortByKeys ($array)
	{
		ksort($array);
		
		return $array;
	}
	
	public static function sortByNumericValue ($array)
	{
		sort($array, SORT_NUMERIC);
		
		return $array;
	}
	
	public static function sortByCharacterLength ($array)
	{
		function customSort ($a, $b)
		{
			return XXX_String::getCharacterLength($a) - XXX_String::getCharacterLength($b);
		}
		
		usort($array, 'customSort');
		
		return $array;
	}
	
	// DateRange is an array consisting of 2 date objects, so [Date, Date]
	
	public static function sortByDateAndDateRanges ($array)
	{
		function customSort ($a, $b)
		{
			if (XXX_Type::isArray($a))
			{
				$a = $a[0];	
			}
			
			if (XXX_Type::isArray($b))
			{
				$b = $b[0];	
			}
			
			return $a->getTimestamp() - $b->getTimestamp();
		}
		
		usort($array, 'customSort');
		
		return $array;
	}
	
	public static function sortByDateRangeLength ($array)
	{
		function customSort ($a, $b)
		{
			$aDifference = 0;
			$bDifference = 0;
			
			if (XXX_Type::isArray($a))
			{
				if ($a[0]->getTimestamp() <= $a[1]->getTimestamp())
				{
					$aDifference = $a[1]->getTimestamp() - $a[0]->getTimestamp();
				}
				else
				{
					$aDifference = $a[0]->getTimestamp() - $a[1]->getTimestamp();
				}
			}
			
			if (XXX_Type::isArray($b))
			{
				if ($b[0]->getTimestamp() <= $b[1]->getTimestamp())
				{
					$bDifference = $b[1]->getTimestamp() - $b[0]->getTimestamp();
				}
				else
				{
					$bDifference = $b[0]->getTimestamp() - $b[1]->getTimestamp();
				}	
			}
			
			return $aDifference - $bDifference;
		}
		
		usort($array, 'customSort');
		
		return $array;
	}
	
	////////////////////
	// Filtering
	////////////////////
	
	public static function filterOutUndefined ($array)
	{
		$cleanArray = array();
		
		foreach ($array as $value)
		{
			if (!XXX_Type::isVariableUndefined($value))
			{
				$cleanArray[] = $value;	
			}
		}
		
		return $cleanArray;
	}
	
	public static function filterOutNull ($array)
	{
		$cleanArray = array();
		
		foreach ($array as $value)
		{
			if (!XXX_Type::isNull($value))
			{
				$cleanArray[] = $value;	
			}
		}
		
		return $cleanArray;
	}
	
	public static function filterOutEmpty ($array)
	{
		$cleanArray = array();
		
		foreach ($array as $value)
		{
			if (!XXX_Type::isValue($value))
			{
				$cleanArray[] = $value;	
			}
		}
		
		return $cleanArray;
	}
	
	////////////////////
	// Copy
	////////////////////
	
	public static function copy ($array)
	{
		return $array;	
	}
	
	////////////////////
	// Shuffle
	////////////////////
	
	public static function shuffle ($array)
	{
		shuffle($array);
		
		return $array;
	}
	
	// E.g. Path_To_doSomething
	
	public static function traverseKeyPath ($array, $keyPath)
	{
		$keyPathParts = XXX_String::splitToArray($keyPath, '>');
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($keyPathParts); $i < $iEnd; ++$i)
		{
			$array = $array[$keyPathParts[$i]];
		}
		
		return $array;
	}
	
	public static function &traverseKeyPathWithReference (&$array, $keyPath)
	{
		$keyPathParts = XXX_String::splitToArray($keyPath, '>');
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($keyPathParts); $i < $iEnd; ++$i)
		{
			$array = $array[$keyPathParts[$i]];
		}
		
		return $array;
	}
	
	// Create key from path
	
	public static function setValueForKeyPath (&$array, $keyPath, $value)
	{
		$currentItem =& $array;
		
		foreach ($keyPath as $key)
		{
			if (!isset($currentItem[$key]))
			{
				$currentItem[$key] = array();
			}
			
			$currentItem =& $currentItem[$key];
		}
		
		$currentItem = $value;
	}
}

?>
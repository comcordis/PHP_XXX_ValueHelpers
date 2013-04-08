<?php

abstract class XXX_String_Levenshtein
{
	// The character difference in a string
	public static function getDistance ($a, $b)
	{
		$cost = 0;
		
		$m = self::getCharacterLength($a);
		$n = self::getCharacterLength($b);
		
		$c = 0;
		
		if ($m < $n)
		{
			$c = $a;
			$a = $b;
			$b = $c;
			
			$o = $m;
			$m = $n;
			$n = $o;
		}
		
		$r = array();
		$r[0] = array();
		
		for ($c = 0, $cEnd = $n + 1; $c < $cEnd; ++$c)
		{
			$r[0][$c] = $c;
		}
		
		for ($i = 1, $iEnd = $m + 1; $i < $iEnd; ++$i)
		{
			$r[$i] = array();
			$r[$i][0] = $i;
			
			for ($j = 1, $jEnd = $n + 1; $j < $jEnd; ++$j)
			{
				$cost = (self::getPart($a, $i - 1, 1) == self::getPart($b, $i - 1, 1)) ? 0 : 1;
				$r[$i][$j] = XXX_Number::lowest(($r[$i - 1][$j] + 1), ($r[$i][$j - 1] + 1), ($r[$i - 1][$j - 1] + $cost));
			}
		}
		
		return $r[$m][$n];
	}
	
	public static function getInformation ($a, $b)
	{
		$levenshteinDistance = XXX_String_Levenshtein::getDistance($a, $b);
		
		$identical = $levenshteinDistance === 0;
		
		$longestCharacterLength = XXX_Number::highest(XXX_String::getCharacterLength($a), XXX_String::getCharacterLength($b));
		
		// Percentage identical
		$percentage = (1 - ($levenshteinDistance / $longestCharacterLength)) * 100;
		
		$result = array
		(
			'identical' => $identical,
			'distance' => $levenshteinDistance,
			'percentage' => $percentage			
		);
		
		return $result;
	}
}

?>
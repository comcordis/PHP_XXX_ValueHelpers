<?php

abstract class XXX_Number
{
	////////////////////
	// Random
	////////////////////
	
	
	// Fraction (0 - 1)
	public static function getRandomFraction ()
	{
		// Seed the randomizer
		mt_srand(microtime() * mt_rand(0, 1234567890));
		
		$minimum = 0;
		$maximum = mt_getrandmax();
		
		$random = mt_rand($minimum, $maximum);	
		$random = $random / $maximum;
		
		return $random;
	}
	
	public static function getRandomNumber ($minimum = 0, $maximum = 1)
	{
		return self::round($minimum + (($maximum - $minimum) * self::getRandomFraction()));
	}
	
	////////////////////
	// Base
	////////////////////
	
	public static function convertBase ($number = 0, $from = 10, $to = 10)
	{
		$number = XXX_Type::makeString($number);
		
		// Only works up to base 36
		$number = base_convert($number, $from, $to);
				
		return $number;
	}
	
	public static function decimalToBinary ($decimalNumber = 0)
	{
		return decbin($decimalNumber);
	}
	
	public static function binaryToDecimal ($binaryNumber = '')
	{
		return bindec($binaryNumber);
	}
				
	////////////////////
	// Lowest & Highest
	////////////////////
	
	public static function lowest ()
	{
		$lowest;
		
		$arguments = func_get_args();
		
		if (XXX_Array::getFirstLevelItemTotal($arguments))
		{
			$lowest = $arguments[0];
			
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($arguments); $i < $iEnd; ++$i)
			{
				$lowest = min($arguments[$i], $lowest);
			}
		}
		else
		{
			$lowest = 0;
		}
		
		return $lowest;
	}
	
	public static function highest ()
	{
		$highest;
		
		$arguments = func_get_args();
		
		if (XXX_Array::getFirstLevelItemTotal($arguments))
		{
			$highest = $arguments[0];
			
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($arguments); $i < $iEnd; ++$i)
			{
				$highest = max($arguments[$i], $highest);
			}
		}
		else
		{
			$highest = 0;
		}
		
		return $highest;
	}
	
	////////////////////
	// Force in range
	////////////////////
	
	public static function forceInRange ($value, $minimum, $maximum)
	{
		return max($minimum, min($value, $maximum));	
	}
	
	public static function forceMinimum ($value, $minimum)
	{
		return max($minimum, $value);	
	}
	
	public static function forceMaximum ($value, $maximum)
	{
		return min($maximum, $value);	
	}
	
	////////////////////
	// Rounding
	////////////////////
		
	public static function floor ($value)
	{
		$value = floor($value);	
		
		$value = intval($value, 10);
		
		return $value;
	}
	
	public static function ceil ($value)
	{
		$value = ceil($value);
		
		$value = intval($value, 10);
		
		return $value;
	}
	
	public static function round ($value, $decimals = 0)
	{
		$value = round($value, $decimals);
		
		if ($decimals == 0)
		{
			$value = intval($value, 10);
		}
		
		return $value;
	}
					
	////////////////////
	// Range hit test
	////////////////////
	
	public static function testRangeHit ($fromA = 0, $tillA = 1, $fromB = 2, $tillB = 3)
	{
		$result = false;
		
		$spanA = $tillA - $fromA;		
		$spanB = $tillB - $fromB;
		
		if ($spanA >= $spanB)
		{
			if (($fromB <= $fromA && $tillB >= $tillA) || ($fromB >= $fromA && $fromB <= $tillA) || ($tillB >= $fromA && $tillB <= $tillA))
			{
				$result = true;
			}
		}
		else
		{
			if (($fromA <= $fromB && $tillA >= $tillB) || ($fromA >= $fromB && $fromA <= $tillB) || ($tillA >= $fromB && $tillA <= $tillB))
			{
				$result = true;
			}
		}
		
		return $result;
	}
	
	////////////////////
	// Randomizer
	////////////////////
	
	public static function seedRandomizer ()
	{
		// Seed the randomizer
		srand(microtime() * rand(1, 1234567890));
		mt_srand(microtime() * mt_rand(1, 1234567890));
	}
	
	////////////////////
	// Math
	////////////////////
	
	public static function power ($value, $power)
	{
		return pow($value, $power);	
	}
	
	public static function squareRoot ($value)
	{
		return sqrt($value);
	}
	
	// Value without - or +
	public static function absolute ($value)
	{
		return abs($value);	
	}
	
	
	public static function pi ($value)
	{
		return pi();	
	}
	
	public static function sine ($value)
	{
		return sin($value);	
	}
	
	public static function arcSine ($value)
	{
		return asin($value);	
	}
	
	public static function cosine ($value)
	{
		return cos($value);	
	}
	
	public static function arcCosine ($value)
	{
		return acos($value);	
	}
	
	public static function tangent ($value)
	{
		return tan($value);	
	}
	
	public static function arcTangent ($value)
	{
		return atan($value);	
	}
	
	public static function log ($value)
	{
		return log($value);	
	}
}

?>
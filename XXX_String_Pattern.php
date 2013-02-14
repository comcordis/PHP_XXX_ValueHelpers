<?php

abstract class XXX_String_Pattern
{
	public static $delimiter = '`';
	
	////////////////////
	// Patterns
	////////////////////
	
	// Use u pattern modifier for additional unicode support like character classes etc. and prefix with (*UTF8)
	
	// User e pattern modifier does normal substitution of backreferences in the replacement string, evaluates it as PHP code, and uses the result for replacing the search string. Single quotes, double quotes, backslashes (\) and NULL chars will be escaped by backslashes in substituted backreferences. 
	
	// Check if a string matches a pattern
	public static function hasMatch ($string, $pattern = '', $patternModifiers= '')
	{
		$result = preg_match(self::$delimiter . $pattern . self::$delimiter . $patternModifiers, $string, $matches);
		
		return $result ? true : false;
	}
	
	// Replace a pattern within a string
	public static function replace ($string, $pattern = '', $patternModifiers= '', $replacement = '', $limit = -1)
	{
		return preg_replace(self::$delimiter . $pattern . self::$delimiter . $patternModifiers, $replacement, $string, $limit);
	}
	
	// Replace a pattern with a callback function within a string
	public static function replaceWithCallback ($string, $pattern = '', $patternModifiers= '', $callback = '')
	{
		return preg_replace_callback(self::$delimiter . $pattern . self::$delimiter . $patternModifiers, $callback, $string);
	}
	
	/*
	
	array
	(
		0 => 'full match',
		
		1 => 'reference group 1',
		
		2 => 'reference group 2'
	)
	
	*/
	
	public static function getMatch ($string, $pattern = '', $patternModifiers= '')
	{
		$result = preg_match(self::$delimiter . $pattern . self::$delimiter . $patternModifiers, $string, $matches);
		
		if (!$result)
		{
			$result = false;
		}
		else
		{
			$result = $matches;
		}
		
		return $result;
	}
	
	/*
	
	array
	(
		0 => array
		(
			0 => 'full match 1',
			1 => 'full match 2'
		),
		
		1 => array
		(
			0 => 'reference group 1 of match 1',
			1 => 'reference group 1 of match 2'
		),
		
		2 => array
		(
			0 => 'reference group 2 of match 1',
			1 => 'reference group 2 of match 2'
		)
	)
	
	*/
	
	
	// Get all matches found by a pattern within a string
	public static function getMatches ($string, $pattern = '', $patternModifiers= '', $ordered = true)
	{			
		preg_match_all(self::$delimiter . $pattern . self::$delimiter . $patternModifiers, $string, $matches, $ordered ? PREG_PATTERN_ORDER : PREG_SET_ORDER);
		
		return $matches;
	}
	
	// Split by a pattern within a string
	public static function splitToArray ($string, $pattern = '', $patternModifiers = '')
	{
		return preg_split(self::$delimiter . $pattern . self::$delimiter . $patternModifiers, $string);
	}
	
	// Escape regular expression characters and the pattern delimiter
	public static function escape ($string)
	{
		return preg_quote($string, self::$delimiter);
	}
}

?>
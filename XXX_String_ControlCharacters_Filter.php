<?php

abstract class XXX_String_ControlCharacters_Filter
{
	// All control characters except \t \r \n
	public static function convertValidControlCharactersToPlaceHolders ($string)
	{
		$string = XXX_String::replace($string, "\r", '...BACKSLASHRPLACEHOLDER...');
		$string = XXX_String::replace($string, "\n", '...BACKSLASHNPLACEHOLDER...');
		$string = XXX_String::replace($string, "\t", '...BACKSLASHTPLACEHOLDER...');
		
		return $string;
	}
	
	public static function convertPlaceHoldersToValidControlCharacters ($string)
	{
		$string = XXX_String::replace($string, '...BACKSLASHRPLACEHOLDER...', "\r");
		$string = XXX_String::replace($string, '...BACKSLASHNPLACEHOLDER...', "\n");
		$string = XXX_String::replace($string, '...BACKSLASHTPLACEHOLDER...', "\t");
		
		return $string;
	}
	
	public static function isValid ($string)
	{
		$string = self::convertValidControlCharactersToPlaceHolders($string);
		
		return !XXX_String_Pattern::hasMatch($string, '\p{C}', 'u');
	}
	
	// Remove  control characters
	public static function filter ($string)
	{
		$string = self::convertValidControlCharactersToPlaceHolders($string);
		$string = XXX_String_Pattern::replace($string, '\p{C}', 'u', '');
		$string = self::convertPlaceHoldersToValidControlCharacters($string);
		
		return $string;
	}
}

?>
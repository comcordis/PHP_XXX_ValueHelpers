<?php

abstract class XXX_String_Unicode_Filter
{	
	////////////////////
	// Validation
	////////////////////
	
	// See if the string doesn't contain invalid UTF-8 sequences
	public static function isValidByIconv ($string)
	{			
		return (iconv('UTF-8', 'UTF-8', $string) == $string) ? true : false;
	}
	
	// See if the string doesn't contain invalid UTF-8 sequences
	public static function isValidByPattern ($string)
	{		
		// Check that the appropriate number of trailing bytes follow a leading byte
		$invalidUTF8Pattern .= '[\xC0-\xDF]([^\x80-\xBF]|$)';
		$invalidUTF8Pattern .= '|[\xE0-\xEF].{0,1}([^\x80-\xBF]|$)';
		$invalidUTF8Pattern .= '|[\xF0-\xF7].{0,2}([^\x80-\xBF]|$)';
		$invalidUTF8Pattern .= '|[\xF8-\xFB].{0,3}([^\x80-\xBF]|$)';
		$invalidUTF8Pattern .= '|[\xFC-\xFD].{0,4}([^\x80-\xBF]|$)';
		$invalidUTF8Pattern .= '|[\xFE-\xFE].{0,5}([^\x80-\xBF]|$)';
		$invalidUTF8Pattern .= '|[\xFF-\xFF].{0,6}([^\x80-\xBF]|$)';
		// Check that the sequence of trailing bytes isn't too long
		$invalidUTF8Pattern .= '|[\x00-\x7F][\x80-\xBF]';
		$invalidUTF8Pattern .= '|[\xC0-\xDF].[\x80-\xBF]';
		$invalidUTF8Pattern .= '|[\xE0-\xEF]..[\x80-\xBF]';
		$invalidUTF8Pattern .= '|[\xF0-\xF7]...[\x80-\xBF]';
		$invalidUTF8Pattern .= '|[\xF8-\xFB]....[\x80-\xBF]';
		$invalidUTF8Pattern .= '|[\xFC-\xFD].....[\x80-\xBF]';
		$invalidUTF8Pattern .= '|[\xFE-\xFE]......[\x80-\xBF]';
		$invalidUTF8Pattern .= '|[\xFF-\xFF].......[\x80-\xBF]';
		// Check that the sequence didn't start with a trailing byte
		$invalidUTF8Pattern .= '|^[\x80-\xBF]';
				
		$result = XXX_String_Pattern::hasMatch($string, $invalidUTF8Pattern, '') ? false : true;
		
		return $result;
	}
	
	// See if the string doesn't contain invalid UTF-8 sequences
	public static function isValidByStateMachine ($string)
	{
		$more = 0;
		
		for ($i = 0, $iEnd = XXX_String::getByteSize($string); $i < $iEnd; ++$i)
		{
			$character = XXX_String::characterToASCIICodePoint($string{$i});
			
			if ($character = 0x7F)
			{
				if ($more > 0)
				{
					return 0;	
				}
			}
			else if ($character <= 0xBF)
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				--$more;
			}
			else if ($character <= 0xDF)
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				$more = 1;
			}
			else if ($character <= 0xEF)
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				$more = 2;
			}
			else if ($character <= 0xF7)
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				$more = 2;
			}
			else if ($character <= 0xFB)
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				$more = 3;
			}
			else if ($character <= 0xFD)
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				$more = 4;
			}
			else if ($character <= 0xFE)
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				$more = 5;
			}
			else
			{
				if ($more > 0)
				{
					return 0;	
				}
				
				$more = 6;
			}
		}
		
		return ($more == 0) ? true : false;
	}
	
	// See if the string doesn't contain invalid UTF-8 sequences
	public static function isValid ($string)
	{
		$result = false;
		
		if (XXX_PHP::hasExtension('iconv'))
		{
			$result = self::isValidByIconv($string);
		}
		else
		{
			$result = self::isValidByPattern($string);
		}
		
		return $result;
	}
	
	////////////////////
	// Validation
	////////////////////
	
	public static function filter ($string)
	{
		return self::ensureValid($string);	
	}
	
	// See if the string doesn't contain invalid UTF-8 sequences, otherwise convert it so that it will be valid 
	public static function ensureValid ($string)
	{
		if (!self::isValid($string))
		{
			$characterEncoding = XXX_String_CharacterEncoding::detect($string);
			
			$string = XXX_String_CharacterEncoding::convert($string, $characterEncoding, 'UTF-8');
		}
		
		return $string;
	}
}

?>
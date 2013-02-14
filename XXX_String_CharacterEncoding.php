<?php

// Encoding (Character Set)

abstract class XXX_String_CharacterEncoding
{
	// Detect character encoding
	public static function detect ($string = '')
	{
		$characterEncoding = 'ISO-8859-1';	
	
		if (XXX_PHP::hasExtension('mb'))
		{
			$characterEncoding = mb_detect_encoding($string);
		}
		
		return $characterEncoding;
	}
	
	// Convert character encoding
	public static function convert ($string = '', $inputCharacterEncoding = 'ASCII', $outputCharacterEncoding = 'UTF-8')
	{
		$result = '';
		
		if (XXX_PHP::hasExtension('iconv'))
		{
			$result = iconv($inputCharacterEncoding, $outputCharacterEncoding, $string);	
		}
		else
		{
			if (inputCharacterEncoding == 'ISO-8859-1' && $outputCharacterEncoding == 'UTF-8')
			{
				// TODO: now encodes an ISO-8859-1 string to UTF-8
				$result = utf8_encode($string);
			}
		}
	
		return $result;
	}
}

?>
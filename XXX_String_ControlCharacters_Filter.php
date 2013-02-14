<?php

abstract class XXX_String_ControlCharacters_Filter
{
	public static function isValid ($string)
	{
		return !XXX_String_Pattern::hasMatch($string, '\p{C}', 'u');
	}
	
	// Remove  control characters
	public static function filter ($string)
	{
		return XXX_String_Pattern::replace($string, '\p{C}', 'u', '');
	}
}

?>
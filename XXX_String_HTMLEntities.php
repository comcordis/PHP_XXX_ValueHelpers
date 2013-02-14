<?php

abstract class XXX_String_HTMLEntities
{	
	// Convert all applicable characters to HTML entities (For example: < to &lt;), (htmlspecialchars only converts special characters, while htmlentities converts all applicable characters)
	public static function encode ($string = '')
	{
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
		
		// htmlspecialchars($string, ENT_QUOTES, 'UTF-8'); 
	}
	
	public static function decode ($string = '')
	{
		return html_entity_decode($string, ENT_QUOTES, 'UTF-8');
	}
}

?>
<?php

// TODO test/make multibyte safe

abstract class XXX_String_Unicode
{
	public static function encodeURIValue ($string = '')
	{
		return urlencode(utf8_encode($string));
	}
	
	public static function decodeURIValue ($string = '')
	{
		return utf8_decode(urldecode($string));
	}
	
	// http://en.wikipedia.org/wiki/Byte_order_mark#Representations_of_byte_order_marks_by_encoding
	public static function composeBOM ()
	{
		return chr(239) . chr(187) . chr(191);
	}
}

?>
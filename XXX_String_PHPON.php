<?php

abstract class XXX_String_PHPON
{
	public static function encode ($data = '')
	{
		return base64_encode(serialize($data));	
	}
	
	public static function decode ($data = '')
	{
		return unserialize(base64_decode($data, true));
	}
}

?>
<?php

abstract class XXX_Object
{
	public static function convertToArray ($value = NULL)
	{
		if (is_object($value))
		{
			// Gets the properties of the given object
			// with get_object_vars function
			$value = get_object_vars($value);
		}
 
		if (is_array($value))
		{
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map('XXX_Object::convertToArray', $value);
		}
		else
		{
			// Return array
			return $value;
		}
	}
}

?>
<?php

abstract class XXX_Default
{
	public static function toOption ($value, $options, $defaultOption)
	{
		if (!XXX_Array::hasValue($options, $value))
		{
			$value = $defaultOption;
		}
		
		return $value;
	}
	
	public static function toIntegerRange ($value, $minimumInteger, $maximumInteger, $defaultInteger)
	{
		if (!XXX_Type::isInteger($value))
		{
			$value = $defaultInteger;
		}
		
		if ($value < $minimumInteger)
		{
			$value = $minimumInteger;
		}
		
		if ($value > $maximumInteger)
		{
			$value = $maximumInteger;
		}
		
		return $value;
	}
	
	public static function toMinimumInteger ($value, $minimumInteger, $defaultInteger)
	{
		if (!XXX_Type::isInteger($value))
		{
			$value = $defaultInteger;
		}
		
		if ($value < $minimumInteger)
		{
			$value = $minimumInteger;
		}
		
		return $value;
	}
	
	public static function toMaximumInteger ($value, $maximumInteger, $defaultInteger)
	{
		if (!XXX_Type::isInteger($value))
		{
			$value = $defaultInteger;
		}
		
		if ($value > $maximumInteger)
		{
			$value = $maximumInteger;
		}
		
		return $value;
	}
	
	public static function toPositiveInteger ($value, $defaultInteger)
	{
		if (!XXX_Type::isInteger($value))
		{
			$value = $defaultInteger;
		}
		
		if ($value < 0)
		{
			$value = $defaultInteger;
		}
		
		return $value;
	}
	
	public static function toString ($value, $defaultString)
	{
		if (!XXX_Type::isString($value))
		{
			$value = $defaultString;
		}
		
		return $value;
	}
	
	public static function toBoolean ($value, $defaultBoolean)
	{
		if (!XXX_Type::isBoolean($value))
		{
			$value = $defaultBoolean ? true : false;
		}
		
		return $value;
	}
}

?>
<?php

abstract class XXX_String_JSON
{
	////////////////////
	// JSON
	////////////////////
	
	public static function encode ($value = '')
	{
		return json_encode($value);	
	}
	
	public static function decode ($value = '')
	{
		return json_decode($value, true);	
	}
	
	public static function convertTo ($value = '')
	{
		// Null
		if (XXX_Type::isNull($value))
		{
			$result = 'null';
		}
		else if (XXX_Type::isArray($value))
		{
			// Associative array
			if (XXX_Type::isAssociativeArray($value))
			{
				$convertedObject = array();
				foreach ($value as $key1 => $value1)
				{
					$convertedObject[] = '\'' . $key1 . '\':' . self::convertTo($value1);
				}
				$result = '{' . XXX_Array::joinValuesToString($convertedObject, ',') . '}';
			}
			// Numeric array
			else
			{
				$convertedArray = array();
				for ($j = 0, $jEnd = count($value); $j < $jEnd; $j++)
				{
					$convertedArray[] = self::convertTo($value[$j]);
				}
				$result = '[' . implode(',', $convertedArray) . ']';
			}
		}
		else
		{
			// Number
			if (XXX_Type::isInteger($value) || XXX_Type::isFloat($value))
			{
				$result = $value;
			}
			// String
			else
			{
				$value = stripslashes(trim($value));
				$value = str_replace(array('\'', '{', '}'), array('\\\'', '\{', '\}'), $value);
				$result = '\'' . $value . '\'';
			}
		}
		
		return $result;
	}
}

?>
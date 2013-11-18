<?php

abstract class XXX_Type
{		
	// lean | full
	public static $arrayLayoutMethod = 'lean';
	public static $comments = true;
	
	////////////////////
	// Boolean
	////////////////////
	
	public static function isBoolean ($value = null)
	{
		return is_bool($value);
	}
	
	public static function isTrue ($value = null)
	{
		return ($value === true);
	}
	
	public static function isFalse ($value = null)
	{
		return ($value === false);
	}
	
	public static function makeBoolean ($value = null)
	{
		return $value ? true : false;
	}
	
	////////////////////
	// Integer
	////////////////////
	
	public static function isInteger ($value = null)
	{
		return is_int($value);
	}
	
	public static function isPositiveInteger ($value = null)
	{
		return is_int($value) && $value >= 0;
	}
	
	public static function isNegativeInteger ($value = null)
	{
		return is_int($value) && $value <= 0;
	}
	
	public static function isEvenInteger ($value = null)
	{
		return is_int($value) && ($value % 2 == 0);
	}
	
	public static function isUnevenInteger ($value = null)
	{
		return is_int($value) && !($value % 2 == 0);
	}
	
	public static function makeInteger ($value = null, $base = 10)
	{		
		return intval($value, $base);
	}
	
	////////////////////
	// Float
	////////////////////
	
	public static function isFloat ($value = null)
	{
		return is_float($value);
	}
	
	public static function isPositiveFloat ($value = null)
	{
		return is_float($value) && $value >= 0;
	}
	
	public static function isNegativeFloat ($value = null)
	{
		return is_float($value) && $value <= 0;
	}
	
	public static function makeFloat ($value = null)
	{		
		return floatval($value);
	}
	
	////////////////////
	// Number (Integer | Float)
	////////////////////
	
	public static function isNumber ($value = null)
	{
		return self::isInteger($value) || self::isFloat($value);
	}
	
	public static function isPositiveNumber ($value = null)
	{
		return self::isNumber($value) && $value >= 0;
	}
	
	public static function isNegativeNumber ($value = null)
	{
		return self::isNumber($value) && $value <= 0;
	}
	
	public static function isEvenNumber ($value = null)
	{
		return self::isNumber($value) && ($value % 2 == 0);
	}
	
	public static function isUnevenNumber ($value = null)
	{
		return self::isNumber($value) && !($value % 2 == 0);
	}
	
	public static function makeNumber ($value = null, $base = 10)
	{
		if (!self::isNumber($value))
		{
			if (!self::isNumeric($value))
			{
				$value = 0;	
			}
			else
			{
				if (self::makeInteger($value) == $value)
				{
					$value = self::makeInteger($value, $base);
				}
				else if (self::makeFloat($value) == $value)
				{
					$value = self::makeFloat($value);
				}
				else
				{
					$value = self::makeInteger($value, $base);
				}
			}
		}
		
		return $value;
	}
	
	////////////////////	
	// Numeric (Integer | Float | String)
	////////////////////
	
	public static function isNumeric ($value = null)
	{
		return self::makeInteger($value) == $value || self::makeFloat($value) == $value;
	}
	
	public static function isPositiveNumeric ($value = null)
	{
		$result = false;
		
		if (self::isNumeric($value))
		{
			$value = self::makeNumber($value);
			
			$result = $value >= 0;
		}
		
		return $result;
	}
	
	public static function isNegativeNumeric ($value = null)
	{
		$result = false;
		
		if (self::isNumeric($value))
		{
			$value = self::makeNumber($value);
			
			$result = $value <= 0;
		}
		
		return $result;
	}
	
	public static function isEvenNumeric ($value = null)
	{
		$result = false;
		
		if (self::isNumeric($value))
		{
			$value = self::makeNumber($value);
			
			$result = $value % 2 == 0;
		}
		
		return $result;
	}
	
	public static function isUnevenNumeric ($value = null)
	{
		$result = false;
		
		if (self::isNumeric($value))
		{
			$value = self::makeNumber($value);
			
			$result = $value % 2 != 0;
		}
		
		return $result;
	}
	
	////////////////////
	// String
	////////////////////
	
	public static function isString ($value = null)
	{
		return is_string($value);
	}
	
	public static function isEmpty ($value = null)
	{		
		return (!isset($value) || ($value === array()) || ($value === null) || ($value === ''));
	}
	
	public static function isValue ($value = null)
	{		
		return (isset($value) && self::isEmpty($value) === false);
	}
	
	public static function isBinaryString ($value = null)
	{
		return is_binary($value);
	}
	
	public static function isUnicodeString ($value = null)
	{
		return is_unicode($value);
	}
	
	public static function makeString ($value = null)
	{		
		return strval($value);
	}
	
	public static function makeUnicodeString ($value = null)
	{		
		$result = strval($value);
		//$result = (string) $result;
		
		return $result;
	}
	
	public static function makeBinaryString ($value = null)
	{		
		$result = strval($value);
		//$result = (binary) $result;
		
		return $result;
	}
	
	////////////////////
	// Array
	////////////////////
	
	public static function isArray ($value = null)
	{
		return is_array($value);
	}
	
	public static function isEmptyArray ($value = null)
	{
		return is_array($value) && XXX_Array::getFirstLevelItemTotal($value) === 0;
	}
	
	public static function isFilledArray ($value = null)
	{
		return is_array($value) && XXX_Array::getFirstLevelItemTotal($value) > 0;
	}
	
	public static function isAssociativeArray ($value = null)
	{
		$result = false;
		
		if (self::isFilledArray($value))
		{			
			foreach (array_keys($value) as $key => $value)
			{
				if ($key !== $value)
				{
					$result = true;
					break;
				}
			}
		}
		
		return $result;
	}
	
	public static function isNumericArray ($value = null)
	{
		$result = false;
		
		if (self::isFilledArray($value))
		{
			$result = self::isAssociativeArray($value) ? false : true;
		}
		
		return $result;
	}
	
	public static function isFunction ($value = null)
	{
		return is_callable($value);
	}
	
	////////////////////
	// Object
	////////////////////
	
	public static function isObject ($value = null)
	{
		return is_object($value);
	}
	
	////////////////////
	// Resource
	////////////////////
	
	public static function isResource ($value = null)
	{
		return is_resource($value);
	}
	
	////////////////////
	// Null
	////////////////////
	
	public static function isNull ($value = 'foo')
	{
		return is_null($value);
	}
	
	////////////////////
	// Timestamp
	////////////////////
	
	public static function isTimestamp ($value)
	{
		return $value instanceof XXX_Timestamp;
	}
	
	////////////////////
	// Constant
	////////////////////
	
	public static function isConstant ($value = null)
	{
		return defined($value);
	}
	
	public static function isConstantDefined ($value = null)
	{
		return defined($value);
	}
	
	public static function isConstantUndefined ($value = null)
	{
		return !defined($value);
	}
	
	////////////////////
	// Variable
	////////////////////
	
	public static function isVariable ($value)
	{
		return isset($value);
	}
	
	public static function isVariableDefined ($value)
	{
		return isset($value);
	}
	
	public static function isVariableUndefined ($value)
	{
		return !isset($value);
	}
	
	////////////////////
	// Peak
	////////////////////
		
	public static function peakAtVariable ()
	{
		$tempArguments = func_get_args();
		
		echo '<pre>' . XXX_String::$lineSeparator;
				
		foreach ($tempArguments as $tempArgument)
		{
			self::peakAtVariableSub($tempArgument);
		}
		
		echo '</pre>' . XXX_String::$lineSeparator;
	}
	
	public static function peakAtVariableSub ($value, $spacing = 0, $identifier = '$variable', $assignmentOperator = ' = ', $lineEnding = ';')
	{
		$renderedSpacing = '';
		
		for ($i = 0, $iEnd = $spacing; $i < $iEnd; ++$i)
		{
			//$renderedSpacing .= '    ';
			$renderedSpacing .= '	';
		}
		
		$renderedLineSeparator = XXX_String::$lineSeparator;
			
		if (XXX_Type::isArray($value))
		{
			$depth = XXX_Array::getDeepestLevel($value);
			$keysOnFirstLevel = XXX_Array::getFirstLevelItemTotal($value);
			
			if (self::$comments)
			{
				$arrayInformation = ' // Array (' . (XXX_Type::isNumericArray($value) ? 'numeric' : 'associative') . ') - ' . $keysOnFirstLevel . ' item(s) - ' . $depth . ' level(s)';
			}
			
			if (XXX_Type::isNumericArray($value))
			{
				echo $renderedSpacing;
				echo $identifier;
				echo $assignmentOperator;
				
				if (self::$arrayLayoutMethod == 'full')
				{
					echo 'array();';
					if (self::$comments)
					{
						echo $arrayInformation;
					}
				}
				else if (self::$arrayLayoutMethod == 'lean')
				{
					echo 'array';
					if (self::$comments)
					{
						echo $arrayInformation;
					}
					echo $renderedLineSeparator;
					echo $renderedSpacing;
					echo '(';
				}
				
				if ($keysOnFirstLevel > 0)
				{
					echo $renderedLineSeparator;
								
					for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($value); $i < $iEnd; ++$i)
					{
						if (self::$arrayLayoutMethod == 'full')
						{
							self::peakAtVariableSub($value[$i], $spacing + 1, $identifier . '[' . $i . ']');						
						}
						else if (self::$arrayLayoutMethod == 'lean')
						{
							self::peakAtVariableSub($value[$i], $spacing + 1, '', '', ($i < $iEnd - 1) ? ',' : '');	
						}						
					}
				}
				
				if (self::$arrayLayoutMethod == 'lean')
				{
					echo $renderedSpacing;
					echo ')';	
					echo $lineEnding;
					echo $renderedLineSeparator;				
				}		
			}
			else if (XXX_Type::isAssociativeArray($value))
			{
				echo $renderedSpacing;
				echo $identifier;
				echo $assignmentOperator;
				
				if (self::$arrayLayoutMethod == 'full')
				{
					echo 'array();';
					if (self::$comments)
					{
						echo $arrayInformation;
					}
				}
				else if (self::$arrayLayoutMethod == 'lean')
				{
					echo 'array';
					if (self::$comments)
					{
						echo $arrayInformation;
					}
					echo $renderedLineSeparator;
					echo $renderedSpacing;
					echo '(';
				}
				
				
				if ($keysOnFirstLevel > 0)
				{
					echo $renderedLineSeparator;
					
					$i = 0;
					$iEnd = XXX_Array::getFirstLevelItemTotal($value);
					
					foreach ($value as $subKey => $subValue)
					{
						if (self::$arrayLayoutMethod == 'full')
						{
							self::peakAtVariableSub($subValue, $spacing + 1, $identifier . '[\'' . XXX_String::addSlashes($subKey) . '\']');
						}
						else if (self::$arrayLayoutMethod == 'lean')
						{
							self::peakAtVariableSub($subValue, $spacing + 1, '\'' . XXX_String::addSlashes($subKey) . '\'', ' => ', ($i < $iEnd - 1) ? ',' : '');	
						}
						
						++$i;
					}
				}
				
				if (self::$arrayLayoutMethod == 'lean')
				{
					echo $renderedSpacing;
					echo ')';
					echo $lineEnding;
					echo $renderedLineSeparator;				
				}
			}
		}
		else if (XXX_Type::isObject($value))
		{
			echo $renderedSpacing;
			echo $identifier;
			echo $assignmentOperator;
			
			echo 'OBJECT';
						
			echo $lineEnding;
			if (self::$comments)
			{
				echo ' // (' . get_class($value) . ') Object / Class / Instance';
				
				// get_object_vars($value)
			}
			echo $renderedLineSeparator;
		}
		else if (XXX_Type::isResource($value))
		{
			echo $renderedSpacing;
			echo $identifier;
			echo $assignmentOperator;
			echo 'RESOURCE';
			echo $lineEnding;
			if (self::$comments)
			{
				echo ' // (' . get_resource_type($value) . ') e.g. Socket connection, MySQL connection, GD Image, File handle etc.';
			}
			echo $renderedLineSeparator;
		}
		else if (XXX_Type::isNull($value))
		{
			echo $renderedSpacing;
			echo $identifier;
			echo $assignmentOperator;
			echo 'null';
			echo $lineEnding;
			if (self::$comments)
			{
				echo ' // Null (Undefined / Empty)';
			}
			echo $renderedLineSeparator;
		}
		else if (XXX_Type::isInteger($value))
		{
			echo $renderedSpacing;
			echo $identifier;
			echo $assignmentOperator;
			echo $value . '';
			echo $lineEnding;
			if (self::$comments)
			{
				echo ' // Integer';
			}
			echo $renderedLineSeparator;
		}
		else if (XXX_Type::isFloat($value))
		{
			echo $renderedSpacing;
			echo $identifier;
			echo $assignmentOperator;
			echo $value . '';
			echo $lineEnding;
			if (self::$comments)
			{
				echo ' // Float';
			}
			echo $renderedLineSeparator;
		}
		else if (XXX_Type::isBoolean($value))
		{
			echo $renderedSpacing;
			echo $identifier;
			echo $assignmentOperator;
			echo ($value ? 'true' : 'false') . '';
			echo $lineEnding;
			if (self::$comments)
			{
				echo ' // Boolean';
			}
			echo $renderedLineSeparator;
		}
		else if (XXX_Type::isString($value))
		{
			$characterLength = XXX_String::getCharacterLength($value);					
			$stringInformation = ' - ' . $characterLength . ' character(s)';
			
			$escapedValue = XXX_String_Pattern::replace($value, '(?<=[^\\\\])\'', 'i', '$1\\\''); 
				
			echo $renderedSpacing;
			echo $identifier;
			echo $assignmentOperator;
			echo '\'' . $escapedValue . '\'' . '';
			echo $lineEnding;
			if (self::$comments)
			{
				echo ' // String' . $stringInformation;
			}
			echo $renderedLineSeparator;
		}
	}
}

?>
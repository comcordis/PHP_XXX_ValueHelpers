<?php


class XXX_String
{
	public static $lineSeparator = "\r\n";
	
	public static $tab = "\t";
	
	public static $space = " ";
	
	public static $singleQuote = "'";
	public static $doubleQuotes = '"';
	
	public static $variableDelimiter = array
	(
		'start' => '%',
		'end' => '%'
	);
		
	public static $dummyText = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris sollicitudin sapien ac tortor. Suspendisse sed lacus. Sed arcu leo, adipiscing sed, viverra porta, condimentum bibendum, mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam sem. Maecenas vitae odio ut magna mollis porta. Fusce massa eros, facilisis in, pharetra sit amet, fringilla sit amet, arcu. Ut posuere lobortis mi. Proin turpis odio, molestie eu, semper sed, malesuada eget, dolor. Vivamus scelerisque, nibh vel aliquam convallis, leo turpis euismod urna, ut condimentum dolor tortor non eros.
	
Nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam blandit, justo vel nonummy facilisis, purus elit ultrices ipsum, et lobortis velit lacus sed erat. Praesent condimentum dui a ligula. Curabitur turpis lacus, aliquet et, dignissim at, imperdiet ac, orci. Pellentesque quis lacus. Cras porttitor. Duis adipiscing cursus tellus. Cras volutpat sagittis erat. Mauris accumsan, tortor quis iaculis molestie, neque mi dictum ante, quis ornare pede quam sit amet magna. Nam pellentesque erat quis arcu. Mauris mattis libero eget felis. Phasellus id eros. Suspendisse posuere facilisis est. Morbi sagittis sagittis mauris. Pellentesque dictum, orci convallis tincidunt scelerisque, augue tortor venenatis magna, id feugiat dolor arcu vitae risus. Aliquam eu erat. Maecenas vel purus rutrum leo tincidunt semper. Pellentesque posuere egestas enim.
	
Donec nec turpis. Fusce in lorem. Sed bibendum sodales massa. Nullam turpis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi vulputate, risus sit amet tincidunt lacinia, elit justo malesuada tortor, tempus interdum ipsum leo et nibh. Vivamus adipiscing. Morbi facilisis porttitor ante. In cursus. Quisque leo risus, gravida adipiscing, mollis sit amet, malesuada sed, diam. Morbi a dui. Suspendisse dapibus turpis et turpis. Mauris in risus eu sapien vulputate porta. Maecenas et urna tempor elit varius venenatis. Aliquam imperdiet, libero et interdum dapibus, nulla leo nonummy risus, nec facilisis lorem quam sed est.';
	
	public static $dummyTextInternational = 'English: a b c d e f g h i j k l m n o p q r s t u v w x y z 0 1 2 3 4 5 6 7 8 9
Russian: а б в г д е ё ж з и й к л м н о п р с т у ф х ц ч ш щ ъ ы ь э ю я
Georgian: აბგდევზთიკლმნოპჟრსტუფქღყშჩცძწჭხჯჰ
Hindi: अ आ इ ई उ ऊ ऋ ऌ ऍ ऎ ए ऐ ऑ ऒ ओ औ क ख ग घ ङ च छ ज झ ञ ट ठ ड ढ ण त थ द ध न ऩ प फ ब भ म य र ऱ ल ळ ऴ व श ष स ह ॐ क़ ख़ ग़ ज़ ड़ ढ़ फ़ य़ ॠ ॡ
Armenian: ա բ գ դ ե զ է ը թ ժ ի լ խ ծ կ հ ձ ղ ճ մ յ ն շ ո չ պ ջ ռ ս վ տ ր ց ւ փ ք օ ֆ եւ
Japanese: ぁ あ ぃ い ぅ う ぇ え ぉ お か が き ぎ く ぐけ げ こ ご さ ざ し じ す ず せ ぜ そ ぞ た だ ち ぢ っ つ づ て で と ど な に ぬ ね の は ば ぱ ひ び ぴ ふ ぶ ぷ へ べ ぺ ほ ぼ ぽ ま み む め も ゃ や ゅ ゆ ょ よ ら る れ ろ ゎ わ を ん
Arabic: ا أ آ إ ب ت ث ج ح خ د ذ ر ز س ش ص ض ط ظ ع غ ف ق ك ل لإ م ن ة ه ە ؤ و ئ ي
Chinese: 一 丁 丂 七 丄 丅 丆 万 丈 三 上 下 丌 不 与 丏 丐 丑 丒 专 且 丕 世 丗 丰 丱 串 丳 临 丵 丶 丷 丸 丹 为 主 丼 丽 举 丿 乀 乁 乂 乃 乄 久 乆 乇
Korean: ᄀ ᄂ ᄃ ᄅ ᄆ ᄇ ᄉ ᅌ ᄌ ᄎ ᄏ ᄐ ᄑ ᄒ ᅡ ᅣᅥ ᅧ ᅩ ᅭ ᅮ ᅲ ᅳ ᅵ
Hebrew: ט ח ז ו ה ד ג ב א ס ן נ ם מ ל ך כ י ת ש ר ק ץ צ ף פ ע
Greek: α β γ δ ε ζ η θ ι κ λ μ ν ξ ο π ρ σ τ υ φ χ ψ ω Α Β Γ Δ Ε Ζ Η Θ Ι Κ Λ Μ Ν Ξ Ο Π Ρ Σ Τ Υ Φ Χ Ψ Ω
Long data: 0000000001000000000100000000010000000001000000000100000000010000000001000000000100000000010000000001
Special characters:  : ; < = > ? @ [ \ ] ^ _ ` { | } ~';

	public static $characterRuler = '....,....1....,....2....,....3....,....4....,....5....,....6....,....7....,....8....,....9....,....0';
		
	
	public static $notationPattern = array('(?:-(?:[a-z]){1})|(?:[A-Z])|(?:_(?:[a-z]){1})|(?:\.(?:[a-z]){1})|(?: +(?:[a-zA-Z]){1})', '');
	
	////////////////////
	// Length / Size / Count
	////////////////////
	
	// Character length
	public static function getCharacterLength ($string)
	{
		$string = (string) $string;
		
		if (XXX_PHP::$nativeUnicode)
		{
			$result = strlen($string);	
		}
		else
		{
			$result = mb_strlen($string, 'UTF-8');
			
			if (!$result)
			{
				$result = iconv_strlen($string, 'UTF-8');
				
				if (!$result)
				{
					$result = strlen($string);	
				}
			}
		}
		
		return $result;
	}
	
	// Byte size
	public static function getByteSize ($string)
	{	
		//$string = (binary) $string;
		
		if (XXX_PHP::$nativeUnicode)
		{
			$result = strlen($string);
		}
		else
		{
			$result = strlen($string);
		}
		
		return $result;
	}
	
	// Word count	
	public static function getWordCount ($value = '')
	{
		$result = 0;
		
		// Normalize line separators
		$value = self::normalizeLineSeparators($value);
		// Normalize line separators to spaces
		$value = XXX_String_Pattern::replace($value, self::$lineSeparator, '', ' ');
		// Normalize tabs to spaces
		$value = XXX_String_Pattern::replace($value, '\\t+', '', ' ');
		// Normalize multiple spaces
		$value = XXX_String_Pattern::replace($value, '\\s+', '', ' ');
		
		$value = explode(' ', $value);
		
		foreach ($value as $word)
		{
			// If it matches a word character
            if (XXX_String_Pattern::hasMatch($word, '[\\w]'))
			{
                ++$result;
            }
        } 
		
		
		return $result;
	}
	
	////////////////////
	// Occurence
	////////////////////
	
	// Find position of first occurrence in string
	public static function findFirstPosition ($haystack, $needle, $offset = 0)
	{
		$haystack = (string) $haystack;
		
		if (XXX_PHP::$nativeUnicode)
		{
			$result = strpos($haystack, $needle, $offset);
		}
		else
		{
			$result = mb_strpos($haystack, $needle, $offset, 'UTF-8');
			
			if (!$result)
			{
				$result = iconv_strpos($haystack, $needle, $offset, 'UTF-8');
				
				if (!$result)
				{
					$result = strpos($haystack, $needle, $offset);
				}
			}
		}
		
		return $result;
	}
	
	// Find position of last occurrence in string
	public static function findLastPosition ($haystack, $needle, $offset = 0)
	{		
		$haystack = (string) $haystack;
		
		if (XXX_PHP::$nativeUnicode)
		{
			$result = strrpos($haystack, $needle, $offset);
		}
		else
		{
			$result = mb_strrpos($haystack, $needle, $offset, 'UTF-8');
			
			if (!$result)
			{
				$result = iconv_strrpos($haystack, $needle, $offset, 'UTF-8');
				
				if (!$result)
				{
					$result = strrpos($haystack, $needle, $offset);
				}
			}
		}
		
		return $result;
	}
	
	////////////////////
	// Part
	////////////////////
	
	// Part of a string
	public static function getPart ($string, $offset, $length = 0)
	{
		$string = (string) $string;
		
		if (XXX_Type::isNull($length) || $length === 0)
		{
			$length = self::getCharacterLength($string);	
		}
		
		if (XXX_PHP::$nativeUnicode)
		{
			$result = substr($string, $offset, $length);
		}
		else
		{
			$result = mb_substr($string, $offset, $length, 'UTF-8');
			
			if (!$result)
			{
				$result = iconv_substr($string, $offset, $length, 'UTF-8');
				
				if (!$result)
				{
					$result = substr($string, $offset, $length);
				}
			}
		}
		
		return $result;
	}
	
	public static function hasPart ($string, $part = '')
	{
		return self::findFirstPosition($string, $part) !== false;
	}
	
	////////////////////
	// Case
	////////////////////
	
	// Convert to upper case
	public static function convertToUpperCase ($string)
	{
		$string = (string) $string;
		
		if (XXX_PHP::$nativeUnicode)
		{
			$result = strtoupper($string);
		}
		else
		{
			$result = mb_strtoupper($string, 'UTF-8');
			
			if (!$result)
			{
				$result = strtoupper($string);
			}
		}
		
		return $result;
	}
	
	// Convert to lower case
	public static function convertToLowerCase ($string)
	{
		$string = (string) $string;
		
		if (XXX_PHP::$nativeUnicode)
		{
			$result = strtolower($string);
		}
		else
		{
			$result = mb_strtolower($string, 'UTF-8');
			
			if (!$result)
			{
				$result = strtolower($string);
			}
		}
		
		return $result;
	}
		
	public static function capitalizeFirstWord ($string)
	{
		return ucfirst($string);
	}
	
	public static function capitalizeWords ($string)
	{
		return ucwords($string);	
	}
	
	////////////////////
	// Replacement
	////////////////////
	
	// Replace variable delimited strings
	public static function replaceVariables ($subject, $variables = '', $values = '')
	{
		$result = false;
		
		if ((XXX_Type::isArray($variables) && XXX_Type::isArray($values)) && (count($variables) === count($values)))
		{			
			foreach ($variables as $key => $value)
			{
				$variables[$key] = XXX_String::$variableDelimiter['start'] . $value . XXX_String::$variableDelimiter['end'];
			}
						
			$result = self::replace($subject, $variables, $values);
		}
		else if (!XXX_Type::isArray($variables) && !XXX_Type::isArray($values))
		{
			$result = self::replace($subject, XXX_String::$variableDelimiter['start'] . $variables . XXX_String::$variableDelimiter['end'], $values);
		}
		
		return $result;
	}
	
	// Replace strings
	public static function replace ($subject, $variables = '', $values = '')
	{		
		$result = false;
				
		if ((XXX_Type::isArray($variables) && XXX_Type::isArray($values)) && (count($variables) === count($values)))
		{			
			$result = str_replace($variables, $values, $subject);
		}
		else if (!XXX_Type::isArray($variables) && !XXX_Type::isArray($values))
		{
			$result = str_replace($variables, $values, $subject);
		}
		
		return $result;
	}
		
	////////////////////
	// HTML 
	////////////////////
	
	public static function stripHTMLTags ($string)
	{
		return strip_tags($string);
	}
	
	public static function disableHTMLTags ($value)
	{
		$value = XXX_String::replace($value, array('<', '>'), array('&lt;', '&gt'));
		
		return $value;
	}
	
	////////////////////
	// ASCII
	////////////////////
	
	public static function asciiCodePointToCharacter ($asciiCodePoint)
	{
		return chr($asciiCodePoint);	
	}
	
	public static function characterToASCIICodePoint ($character)
	{
		return ord($character);	
	}
	
	public static function asciiCharactersToInteger ($string)
	{
		$binaryString = '';
				
		$stringLength = self::getByteSize($string);
		
		for ($i = 0, $iEnd = $stringLength; $i < $iEnd; ++$i)
		{
			$character = self::getPart($string, $i, 1);
			
			// Every character ord()
			$asciiCodePoint = self::characterToASCIICodePoint($character);
			
			
			// code point to binary
			$characterBinary = decbin($asciiCodePoint);
			
			// pad code points to 8 with 0's
			$characterBinary = self::padLeft($characterBinary, '0', 8);
			
			$binaryString .= $characterBinary;
		}
		
		$integer = bindec($binaryString);
		
		return $integer;
	}
		
	public static function integerToAsciiCharacters ($integer)
	{
		$asciiString = '';
		
		// To binary
		$binaryString = decbin($integer);
		
		$binaryStringLength = self::getByteSize($binaryString);
				
		// Hoeveel maal 8 past erin, hoeveel nullen moeten nog ervoor gepad worden
		$eights = ceil($binaryStringLength / 8);
		
		// pad code points to 8 with 0's
		$binaryString = self::padLeft($binaryString, '0', $eights * 8);
		
		
		// Splitten per 8
		for ($i = 0, $iEnd = $eights; $i < $iEnd; ++$i)
		{
			$characterBinary = self::getPart($binaryString, $i * 8, 8);
			
			// omvormen naar decimaal integer
			$asciiCodePoint = bindec($characterBinary);
			
			// chr()
			$character = self::asciiCodePointToCharacter($asciiCodePoint);
			
			$asciiString .= $character;
		}	
		
		return $asciiString;
	}
			
	////////////////////
	// Random
	////////////////////
	
	// Random 32 [a-zA-Z0-9] character hash string
	public static function getRandomHash ()
	{
		return md5(uniqid(rand(), true));
	}
	
	public static function getRandomPassword ($length = 16, $complex = true)
	{
		$result = '';
		
		if ($complex)
		{
	   		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^*()-_=+[{]}|;:,.?';		
		}
		else
		{
	   		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';		
		}
		
	    for ($i = 0; $i < $length; $i++)
	    {
	        $result .= $characters[XXX_Number::getRandomNumber(0, self::getCharacterLength($characters) - 1)];
	    }
	    
	    return $result;
	}
	
	////////////////////
	// Default value
	////////////////////
	
	// Check if the string is empty, otherwise set the default
	public static function setDefaultValue ($string, $defaultValue = '')
	{
		return XXX_Type::isValue($string) ? $string : $defaultValue;
	}
	
	////////////////////
	// Normalizing
	////////////////////
	
	// Convert all line separators to the canonical form
	public static function normalizeLineSeparators ($string)
	{
		$string = self::replace($string, "\r\n", "\n");
		$string = self::replace($string, "\r", "\n");
		$string = self::replace($string, "\n", XXX_String::$lineSeparator);
		
		return $string;
	}
	
	// Convert all white space to a single space
	public static function normalizeWhiteSpace ($string)
	{
		$string = XXX_String_Pattern::replace($string, '\\s+', '', ' ');
		
		return $string;
	}
	
	////////////////////
	// Removing
	////////////////////
	
	public static function removeLineSeparators ($string)
	{
		$string = self::normalizeLineSeparators($string);
		$string = self::replace($string, XXX_String::$lineSeparator, '');
		
		return $string;
	}
	
	////////////////////
	// Formatting notation
	////////////////////
	
	public static function formatToCamelNotation ($string)
	{
		return XXX_String_Pattern::replaceWithCallback($string, self::$notationPattern[0], self::$notationPattern[1], create_function('$a', '$a = $a[0]; if (XXX_String::getCharacterLength($a) == 2) { $a = XXX_String::getPart($a, 1, 1); } return XXX_String::convertToUpperCase($a);'));
	}
	
	public static function formatToDashNotation ($string)
	{
		return XXX_String_Pattern::replaceWithCallback($string, self::$notationPattern[0], self::$notationPattern[1], create_function('$a', '$a = $a[0]; if (XXX_String::getCharacterLength($a) == 2) { $a = XXX_String::getPart($a, 1, 1); } return \'-\' . XXX_String::convertToLowerCase($a);'));
	}
	
	public static function formatToUnderscoreNotation ($string)
	{
		return XXX_String_Pattern::replaceWithCallback($string, self::$notationPattern[0], self::$notationPattern[1], create_function('$a', '$a = $a[0]; if (XXX_String::getCharacterLength($a) == 2) { $a = XXX_String::getPart($a, 1, 1); } return \'_\' . XXX_String::convertToLowerCase($a);'));
	}
	
	public static function formatToSpaceNotation ($string)
	{
		return XXX_String_Pattern::replaceWithCallback($string, self::$notationPattern[0], self::$notationPattern[1], create_function('$a', '$a = $a[0]; if (XXX_String::getCharacterLength($a) == 2) { $a = XXX_String::getPart($a, 1, 1); } return \' \' . XXX_String::convertToLowerCase($a);'));
	}
	
	public static function formatToDotNotation ($string)
	{
		return XXX_String_Pattern::replaceWithCallback($string, self::$notationPattern[0], self::$notationPattern[1], create_function('$a', '$a = $a[0]; if (XXX_String::getCharacterLength($a) == 2) { $a = XXX_String::getPart($a, 1, 1); } return \'.\' . XXX_String::convertToLowerCase($a);'));
	}
	
	////////////////////
	// Begin & End matching
	////////////////////
	
	public static function beginsWith ($string, $begin, $ignoreCase = false)
	{
		$result = false;
		
		if (!$ignoreCase)
		{
			$result = ($begin == self::getPart($string, 0, self::getCharacterLength($begin)));
		}
		else
		{
			$result = (self::convertToLowerCase($begin) == self::convertToLowerCase(self::getPart($string, 0, self::getCharacterLength($begin))));
		}
		
		return $result;
	}
	
	public static function endsWith ($string, $end, $ignoreCase = false)
	{
		$result = false;
		
		if (!$ignoreCase)
		{
			$result = ($end == self::getPart($string, self::getCharacterLength($string) - self::getCharacterLength($end)));
		}
		else
		{
			$result = (self::convertToLowerCase($end) == self::convertToLowerCase(self::getPart($string, self::getCharacterLength($string) - self::getCharacterLength($end))));
		}
		
		return $result;
	}
	
	////////////////////
	// Begin & End chopping
	////////////////////
	
	public static function getBegin ($string, $characterTotal = 1)
	{
		return self::getPart($string, 0, $characterTotal);
	}
	
	public static function getEnd ($string, $characterTotal = 1)
	{
		return self::getPart($string, self::getCharacterLength($string) - $characterTotal);	
	}
		
	////////////////////
	// Trimming
	////////////////////
	
	public static function trim ($string)
	{
		return trim($string);	
	}
	
	public static function trimLimited ($string, $limit = 1)
	{
		$string = XXX_String_Pattern::replace($string, '^\\s', '', '', $limit);
		$string = XXX_String_Pattern::replace($string, '\\s$', '', '', $limit);
		
		return $string;
	}
	
	public static function trimLeft ($string)
	{
		return ltrim($string);
	}
	
	public static function trimRight ($string)
	{
		return rtrim($string);	
	}
	
	public static function truncate ($string, $limit = 1, $break = ' ', $pad = '...')
	{
		$string = XXX_String::normalizeLineSeparators($string);
		
		$value = XXX_String_Pattern::replace($value, XXX_String::$lineSeparator, '', ' ');
		
		$characterLength = XXX_String::getCharacterLength($string);
		
		if ($characterLength > $limit)
		{
			$breakPoint = XXX_String::findFirstPosition($string, $break, $limit);
			
			if ($breakPoint !== false)
			{
				if ($breakPoint < $characterLength - 1)
				{
					$string = XXX_String::getPart($string, 0, $breakPoint) . $pad;
				}
			}
		}
		
		return $string;
	}
			
	////////////////////
	// Slashes
	////////////////////
	
	public static function addSlashes ($string)
	{
		return addslashes($string);
	}
	
	public static function removeSlashes ($string)
	{
		return stripslashes($string);
	}
	
	public static function escape ($string)
	{
		return self::addSlashes($string);
	}
	
	////////////////////
	// Split
	////////////////////
	
	public static function splitToArray ($string, $delimiter)
	{
		return explode($delimiter, $string);	
	}
	
	public static function splitLinesToArray ($string)
	{
		$string = self::normalizeLineSeparators($string);
		
		return self::splitToArray($string, self::$lineSeparator);
	}
	
	public static function splitChunksToArray ($string, $chunkLength = 76)
	{
		return str_split($string, $chunkLength);
	}
	
	////////////////////
	// URI
	////////////////////
	
	public static function encodeURIValue ($string = '')
	{
		return XXX_String_Unicode::encodeURIValue($string);
	}
	
	public static function decodeURIValue ($string = '')
	{
		return XXX_String_Unicode::decodeURIValue($string);
	}
			
	////////////////////
	// Padding
	////////////////////
	
	public static function padLeft ($string, $paddingCharacter, $length)
	{
		return str_pad($string, $length, $paddingCharacter, STR_PAD_LEFT);
	}
	
	public static function padRight ($string, $paddingCharacter, $length)
	{
		return str_pad($string, $length, $paddingCharacter, STR_PAD_RIGHT);
	}
		
	////////////////////
	// File
	////////////////////
	
	public static function getFileExtension ($file = '')
	{
		$fileParts = explode('.', $file);
		
		if (count($fileParts) > 1)
		{
			$fileExtension = array_pop($fileParts);
			
			if (self::endsWith($fileExtension, '~'))
			{
				$fileExtension = self::getPart($fileExtension, 0, -1);
			}
		}
		else
		{
			$fileExtension = '';
		}
				
		return $fileExtension;
	}
	
	public static function getFileName ($file = '')
	{
		$fileParts = explode('.', $file);
		
		$fileExtension = array_pop($fileParts);
		
		if (count($fileParts) > 0)
		{
			$fileName = implode('.', $fileParts);
		}
		else
		{
			$fileName = $fileExtension;	
		}
		
		return $fileName;
	}
		
	////////////////////
	// Pass security rating
	////////////////////
	
	public static function getPassSecurityRating ($value)
	{
		$valueCharacterLength = XXX_String::getCharacterLength($value);
		
		$hasLowerCaseLetter = XXX_String_Pattern::hasMatch($value, '[a-z]', '');
		$hasUpperCaseLetter = XXX_String_Pattern::hasMatch($value, '[A-Z]', '');
		$hasDigit = XXX_String_Pattern::hasMatch($value, '[0-9]', '');
		$hasSpecialCharacter = XXX_String_Pattern::hasMatch($value, '\\W', '');
		
		$rating = 0;
		
		$rating += $valueCharacterLength * 3;
		
		if ($hasLowerCaseLetter)
		{
			$rating += 20;
		}
		
		if ($hasUpperCaseLetter)
		{
			$rating += 20;
		}
		
		if ($hasDigit)
		{
			$rating += 20;
		}
		
		if ($hasSpecialCharacter)
		{
			$rating += 25;
		}
		
		$rating = XXX_Number::lowest(100, $rating);
		
		return $rating;
	}
	
	////////////////////
	// Parts
	////////////////////
	
	public static function hasSeparatedPart ($value = '', $part = '', $separator = '')
	{
		$parts = XXX_String::splitToArray($value, $separator);
		
		return XXX_Array::hasValue($parts, $part);
	}
	
	public static function getLastSeparatedPart ($value = '', $separator = '')
	{
		$parts = XXX_String::splitToArray($value, $separator);
				
		return array_pop($parts);
	}
	
	public static function getFirstSeparatedPart ($value = '', $separator = '')
	{
		$parts = XXX_String::splitToArray($value, $separator);
		
		return array_shift($parts);
	}
	
	public static function removeLastPart ($value = '', $separator = '')
	{
		$parts = XXX_String::splitToArray($value, $separator);
		array_pop($parts);
		
		return XXX_Array::joinValuesToString($parts, $separator);
	}
	
	public static function removeFirstPart ($value = '', $separator = '')
	{
		$parts = XXX_String::splitToArray($value, $separator);
		array_shift($parts);
		
		return XXX_Array::joinValuesToString($parts, $separator);
	}
	
	////////////////////
	// Line separator <br>
	////////////////////
	
	public static function lineSeparatorToBR ($value = '')
	{
		$value = self::normalizeLineSeparators($value);
		$value = self::replace(XXX_String::$lineSeparator, '<br>');
		
		return $value;
	}
	
	public static function brToLineSeparator ($value = '')
	{
		$value = self::replace('<br>', XXX_String::$lineSeparator);
		
		return $value;
	}
	
	////////////////////
	// Unique characters / Entropy
	////////////////////
	
	public static function sortCountsArray ($a, $b)
	{
		return $b['count'] - $a['count'];
	}
	
	public static function getUniqueCharacterInformation ($subject)
	{
		$characterLength = XXX_String::getCharacterLength($subject);
		
		$counts = array();
		
		for ($i = 0, $iEnd = $characterLength; $i < $iEnd; ++$i)
		{
			$character = XXX_String::getCharacterAtPosition($subject, $i);
			
			$alreadyHaveARecord = false;
			
			for ($j = 0, $jEnd = XXX_Array::getFirstLevelItemTotal($counts); $j < $jEnd; ++$j)
			{
				if ($counts[$j]['character'] == $character)
				{
					++$counts[$j]['count'];
				}
			}
			
			if ($alreadyHaveARecord == false)
			{
				$counts[] = array('character' => $character, 'count' => 1);
			}
		}
		
		$uniqueCharacterTotal = XXX_Array::getFirstLevelItemTotal($temp);
		
		$averageCharacterFrequency = $characterLength / $uniqueCharacterTotal;
		
		// Sort from high to low
		uasort($counts, 'XXX_String::sortCountsArray');
		
		/*
		aaaa -> 0%
		aada -> 25%
		aadda -> 40%
		fadda -> 60%
		*/
		
		$percentage = 0;
		$otherCharacterTotal = 0;
		
		if (XXX_Array::getFirstLevelItemTotal($counts) > 1)
		{
			for ($i = 1, $iEnd = XXX_Array::getFirstLevelItemTotal($counts); $i < $iEnd; ++$i)
			{
				$otherCharacterTotal += $counts[$i]['count'];
			}
			
			$percentage = ($otherCharacterTotal / $characterLength) * 100;
		}
		
		$result = array
		(
			'characterLength' => $characterLength,
			'uniqueCharacterTotal' => $uniqueCharacterTotal,
			'otherCharacterTotal' => $otherCharacterTotal,
			'averageCharacterFrequency' => $averageCharacterFrequency,
			'percentage' => $percentage,
			'counts' => $counts
		);
		
		return $result;
	}
	
	/*
	Entropy: Number of bits H it would take to represent every combination of characterLength L with an alphabet of N different characters.
	The higher, the complexer (and thus better for for example a password)
	
	H = L log 2 N
		- H: entropy
		- L: characterLength
		- N: alphabetSize (Usually measured in bits)				
	*/
	public static function getEntropy ($subject)
	{
		$uniqueCharacterInformation = self::getUniqueCharacterInformation($subject);
		
		$characterLength = $uniqueCharacterInformation['characterLength'];
		$alphabetSize = $uniqueCharacterInformation['uniqueCharacterTotal'];
		
		$entropy = 0;
		
		if ($characterLength > 0)
		{
			
			$entropy = ($characterLength * XXX_Number::log($alphabetSize)) / XXX_Number::log(2);
		}
		
		return $entropy;
	}
	
	////////////////////
	// Terms
	////////////////////
	
	public static function sortTermsArray ($a, $b)
	{
		return XXX_String::getCharacterLength($a) - XXX_String::getCharacterLength($b);
	}
	
	public static function splitToTerms ($sentence)
	{
		$sentence = XXX_Type::makeString($sentence);
		
		$terms = XXX_String_Pattern::splitToArray($sentence, '\\s*(?:,|\\(|\\)|\\s)\\s*', '');
		
		uasort($terms, 'XXX_String::sortTermsArray');
						
		$terms = XXX_Array::filterOutEmpty($terms);
		
		return $terms;
	}
}

?>
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
	
	public static function filterSuggestion ($suggestion = '')
	{
		$suggestion = XXX_String_Pattern::replace($suggestion, '\\s{2,}', '', ' ');
		$suggestion = XXX_String::trimLeft($suggestion);
		
		return $suggestion;
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
	
	
	
	////////////////////
	// Accented characters
	////////////////////
	
	public static $accentedCharacterBaseCharacters = array
	(
		'Á' => 'A',
		'Ă' => 'A',
		'Ắ' => 'A',
		'Ặ' => 'A',
		'Ằ' => 'A',
		'Ẳ' => 'A',
		'Ẵ' => 'A',
		'Ǎ' => 'A',
		'Â' => 'A',
		'Ấ' => 'A',
		'Ậ' => 'A',
		'Ầ' => 'A',
		'Ẩ' => 'A',
		'Ẫ' => 'A',
		'Ä' => 'A',
		'Ǟ' => 'A',
		'Ȧ' => 'A',
		'Ǡ' => 'A',
		'Ạ' => 'A',
		'Ȁ' => 'A',
		'À' => 'A',
		'Ả' => 'A',
		'Ȃ' => 'A',
		'Ā' => 'A',
		'Ą' => 'A',
		'Å' => 'A',
		'Ǻ' => 'A',
		'Ḁ' => 'A',
		'Ⱥ' => 'A',
		'Ã' => 'A',
		'Ꜳ' => 'AA',
		'Æ' => 'AE',
		'Ǽ' => 'AE',
		'Ǣ' => 'AE',
		'Ꜵ' => 'AO',
		'Ꜷ' => 'AU',
		'Ꜹ' => 'AV',
		'Ꜻ' => 'AV',
		'Ꜽ' => 'AY',
		'Ḃ' => 'B',
		'Ḅ' => 'B',
		'Ɓ' => 'B',
		'Ḇ' => 'B',
		'Ƀ' => 'B',
		'Ƃ' => 'B',
		'Ć' => 'C',
		'Č' => 'C',
		'Ç' => 'C',
		'Ḉ' => 'C',
		'Ĉ' => 'C',
		'Ċ' => 'C',
		'Ƈ' => 'C',
		'Ȼ' => 'C',
		'Ď' => 'D',
		'Ḑ' => 'D',
		'Ḓ' => 'D',
		'Ḋ' => 'D',
		'Ḍ' => 'D',
		'Ɗ' => 'D',
		'Ḏ' => 'D',
		'ǲ' => 'D',
		'ǅ' => 'D',
		'Đ' => 'D',
		'Ƌ' => 'D',
		'Ǳ' => 'DZ',
		'Ǆ' => 'DZ',
		'É' => 'E',
		'Ĕ' => 'E',
		'Ě' => 'E',
		'Ȩ' => 'E',
		'Ḝ' => 'E',
		'Ê' => 'E',
		'Ế' => 'E',
		'Ệ' => 'E',
		'Ề' => 'E',
		'Ể' => 'E',
		'Ễ' => 'E',
		'Ḙ' => 'E',
		'Ë' => 'E',
		'Ė' => 'E',
		'Ẹ' => 'E',
		'Ȅ' => 'E',
		'È' => 'E',
		'Ẻ' => 'E',
		'Ȇ' => 'E',
		'Ē' => 'E',
		'Ḗ' => 'E',
		'Ḕ' => 'E',
		'Ę' => 'E',
		'Ɇ' => 'E',
		'Ẽ' => 'E',
		'Ḛ' => 'E',
		'Ꝫ' => 'ET',
		'Ḟ' => 'F',
		'Ƒ' => 'F',
		'Ǵ' => 'G',
		'Ğ' => 'G',
		'Ǧ' => 'G',
		'Ģ' => 'G',
		'Ĝ' => 'G',
		'Ġ' => 'G',
		'Ɠ' => 'G',
		'Ḡ' => 'G',
		'Ǥ' => 'G',
		'Ḫ' => 'H',
		'Ȟ' => 'H',
		'Ḩ' => 'H',
		'Ĥ' => 'H',
		'Ⱨ' => 'H',
		'Ḧ' => 'H',
		'Ḣ' => 'H',
		'Ḥ' => 'H',
		'Ħ' => 'H',
		'Í' => 'I',
		'Ĭ' => 'I',
		'Ǐ' => 'I',
		'Î' => 'I',
		'Ï' => 'I',
		'Ḯ' => 'I',
		'İ' => 'I',
		'Ị' => 'I',
		'Ȉ' => 'I',
		'Ì' => 'I',
		'Ỉ' => 'I',
		'Ȋ' => 'I',
		'Ī' => 'I',
		'Į' => 'I',
		'Ɨ' => 'I',
		'Ĩ' => 'I',
		'Ḭ' => 'I',
		'Ꝺ' => 'D',
		'Ꝼ' => 'F',
		'Ᵹ' => 'G',
		'Ꞃ' => 'R',
		'Ꞅ' => 'S',
		'Ꞇ' => 'T',
		'Ꝭ' => 'IS',
		'Ĵ' => 'J',
		'Ɉ' => 'J',
		'Ḱ' => 'K',
		'Ǩ' => 'K',
		'Ķ' => 'K',
		'Ⱪ' => 'K',
		'Ꝃ' => 'K',
		'Ḳ' => 'K',
		'Ƙ' => 'K',
		'Ḵ' => 'K',
		'Ꝁ' => 'K',
		'Ꝅ' => 'K',
		'Ĺ' => 'L',
		'Ƚ' => 'L',
		'Ľ' => 'L',
		'Ļ' => 'L',
		'Ḽ' => 'L',
		'Ḷ' => 'L',
		'Ḹ' => 'L',
		'Ⱡ' => 'L',
		'Ꝉ' => 'L',
		'Ḻ' => 'L',
		'Ŀ' => 'L',
		'Ɫ' => 'L',
		'ǈ' => 'L',
		'Ł' => 'L',
		'Ǉ' => 'LJ',
		'Ḿ' => 'M',
		'Ṁ' => 'M',
		'Ṃ' => 'M',
		'Ɱ' => 'M',
		'Ń' => 'N',
		'Ň' => 'N',
		'Ņ' => 'N',
		'Ṋ' => 'N',
		'Ṅ' => 'N',
		'Ṇ' => 'N',
		'Ǹ' => 'N',
		'Ɲ' => 'N',
		'Ṉ' => 'N',
		'Ƞ' => 'N',
		'ǋ' => 'N',
		'Ñ' => 'N',
		'Ǌ' => 'NJ',
		'Ó' => 'O',
		'Ŏ' => 'O',
		'Ǒ' => 'O',
		'Ô' => 'O',
		'Ố' => 'O',
		'Ộ' => 'O',
		'Ồ' => 'O',
		'Ổ' => 'O',
		'Ỗ' => 'O',
		'Ö' => 'O',
		'Ȫ' => 'O',
		'Ȯ' => 'O',
		'Ȱ' => 'O',
		'Ọ' => 'O',
		'Ő' => 'O',
		'Ȍ' => 'O',
		'Ò' => 'O',
		'Ỏ' => 'O',
		'Ơ' => 'O',
		'Ớ' => 'O',
		'Ợ' => 'O',
		'Ờ' => 'O',
		'Ở' => 'O',
		'Ỡ' => 'O',
		'Ȏ' => 'O',
		'Ꝋ' => 'O',
		'Ꝍ' => 'O',
		'Ō' => 'O',
		'Ṓ' => 'O',
		'Ṑ' => 'O',
		'Ɵ' => 'O',
		'Ǫ' => 'O',
		'Ǭ' => 'O',
		'Ø' => 'O',
		'Ǿ' => 'O',
		'Õ' => 'O',
		'Ṍ' => 'O',
		'Ṏ' => 'O',
		'Ȭ' => 'O',
		'Ƣ' => 'OI',
		'Ꝏ' => 'OO',
		'Ɛ' => 'E',
		'Ɔ' => 'O',
		'Ȣ' => 'OU',
		'Ṕ' => 'P',
		'Ṗ' => 'P',
		'Ꝓ' => 'P',
		'Ƥ' => 'P',
		'Ꝕ' => 'P',
		'Ᵽ' => 'P',
		'Ꝑ' => 'P',
		'Ꝙ' => 'Q',
		'Ꝗ' => 'Q',
		'Ŕ' => 'R',
		'Ř' => 'R',
		'Ŗ' => 'R',
		'Ṙ' => 'R',
		'Ṛ' => 'R',
		'Ṝ' => 'R',
		'Ȑ' => 'R',
		'Ȓ' => 'R',
		'Ṟ' => 'R',
		'Ɍ' => 'R',
		'Ɽ' => 'R',
		'Ꜿ' => 'C',
		'Ǝ' => 'E',
		'Ś' => 'S',
		'Ṥ' => 'S',
		'Š' => 'S',
		'Ṧ' => 'S',
		'Ş' => 'S',
		'Ŝ' => 'S',
		'Ș' => 'S',
		'Ṡ' => 'S',
		'Ṣ' => 'S',
		'Ṩ' => 'S',
		'Ť' => 'T',
		'Ţ' => 'T',
		'Ṱ' => 'T',
		'Ț' => 'T',
		'Ⱦ' => 'T',
		'Ṫ' => 'T',
		'Ṭ' => 'T',
		'Ƭ' => 'T',
		'Ṯ' => 'T',
		'Ʈ' => 'T',
		'Ŧ' => 'T',
		'Ɐ' => 'A',
		'Ꞁ' => 'L',
		'Ɯ' => 'M',
		'Ʌ' => 'V',
		'Ꜩ' => 'TZ',
		'Ú' => 'U',
		'Ŭ' => 'U',
		'Ǔ' => 'U',
		'Û' => 'U',
		'Ṷ' => 'U',
		'Ü' => 'U',
		'Ǘ' => 'U',
		'Ǚ' => 'U',
		'Ǜ' => 'U',
		'Ǖ' => 'U',
		'Ṳ' => 'U',
		'Ụ' => 'U',
		'Ű' => 'U',
		'Ȕ' => 'U',
		'Ù' => 'U',
		'Ủ' => 'U',
		'Ư' => 'U',
		'Ứ' => 'U',
		'Ự' => 'U',
		'Ừ' => 'U',
		'Ử' => 'U',
		'Ữ' => 'U',
		'Ȗ' => 'U',
		'Ū' => 'U',
		'Ṻ' => 'U',
		'Ų' => 'U',
		'Ů' => 'U',
		'Ũ' => 'U',
		'Ṹ' => 'U',
		'Ṵ' => 'U',
		'Ꝟ' => 'V',
		'Ṿ' => 'V',
		'Ʋ' => 'V',
		'Ṽ' => 'V',
		'Ꝡ' => 'VY',
		'Ẃ' => 'W',
		'Ŵ' => 'W',
		'Ẅ' => 'W',
		'Ẇ' => 'W',
		'Ẉ' => 'W',
		'Ẁ' => 'W',
		'Ⱳ' => 'W',
		'Ẍ' => 'X',
		'Ẋ' => 'X',
		'Ý' => 'Y',
		'Ŷ' => 'Y',
		'Ÿ' => 'Y',
		'Ẏ' => 'Y',
		'Ỵ' => 'Y',
		'Ỳ' => 'Y',
		'Ƴ' => 'Y',
		'Ỷ' => 'Y',
		'Ỿ' => 'Y',
		'Ȳ' => 'Y',
		'Ɏ' => 'Y',
		'Ỹ' => 'Y',
		'Ź' => 'Z',
		'Ž' => 'Z',
		'Ẑ' => 'Z',
		'Ⱬ' => 'Z',
		'Ż' => 'Z',
		'Ẓ' => 'Z',
		'Ȥ' => 'Z',
		'Ẕ' => 'Z',
		'Ƶ' => 'Z',
		'Ĳ' => 'IJ',
		'Œ' => 'OE',
		'ᴀ' => 'A',
		'ᴁ' => 'AE',
		'ʙ' => 'B',
		'ᴃ' => 'B',
		'ᴄ' => 'C',
		'ᴅ' => 'D',
		'ᴇ' => 'E',
		'ꜰ' => 'F',
		'ɢ' => 'G',
		'ʛ' => 'G',
		'ʜ' => 'H',
		'ɪ' => 'I',
		'ʁ' => 'R',
		'ᴊ' => 'J',
		'ᴋ' => 'K',
		'ʟ' => 'L',
		'ᴌ' => 'L',
		'ᴍ' => 'M',
		'ɴ' => 'N',
		'ᴏ' => 'O',
		'ɶ' => 'OE',
		'ᴐ' => 'O',
		'ᴕ' => 'OU',
		'ᴘ' => 'P',
		'ʀ' => 'R',
		'ᴎ' => 'N',
		'ᴙ' => 'R',
		'ꜱ' => 'S',
		'ᴛ' => 'T',
		'ⱻ' => 'E',
		'ᴚ' => 'R',
		'ᴜ' => 'U',
		'ᴠ' => 'V',
		'ᴡ' => 'W',
		'ʏ' => 'Y',
		'ᴢ' => 'Z',
		'á' => 'a',
		'ă' => 'a',
		'ắ' => 'a',
		'ặ' => 'a',
		'ằ' => 'a',
		'ẳ' => 'a',
		'ẵ' => 'a',
		'ǎ' => 'a',
		'â' => 'a',
		'ấ' => 'a',
		'ậ' => 'a',
		'ầ' => 'a',
		'ẩ' => 'a',
		'ẫ' => 'a',
		'ä' => 'a',
		'ǟ' => 'a',
		'ȧ' => 'a',
		'ǡ' => 'a',
		'ạ' => 'a',
		'ȁ' => 'a',
		'à' => 'a',
		'ả' => 'a',
		'ȃ' => 'a',
		'ā' => 'a',
		'ą' => 'a',
		'ᶏ' => 'a',
		'ẚ' => 'a',
		'å' => 'a',
		'ǻ' => 'a',
		'ḁ' => 'a',
		'ⱥ' => 'a',
		'ã' => 'a',
		'ꜳ' => 'aa',
		'æ' => 'ae',
		'ǽ' => 'ae',
		'ǣ' => 'ae',
		'ꜵ' => 'ao',
		'ꜷ' => 'au',
		'ꜹ' => 'av',
		'ꜻ' => 'av',
		'ꜽ' => 'ay',
		'ḃ' => 'b',
		'ḅ' => 'b',
		'ɓ' => 'b',
		'ḇ' => 'b',
		'ᵬ' => 'b',
		'ᶀ' => 'b',
		'ƀ' => 'b',
		'ƃ' => 'b',
		'ɵ' => 'o',
		'ć' => 'c',
		'č' => 'c',
		'ç' => 'c',
		'ḉ' => 'c',
		'ĉ' => 'c',
		'ɕ' => 'c',
		'ċ' => 'c',
		'ƈ' => 'c',
		'ȼ' => 'c',
		'ď' => 'd',
		'ḑ' => 'd',
		'ḓ' => 'd',
		'ȡ' => 'd',
		'ḋ' => 'd',
		'ḍ' => 'd',
		'ɗ' => 'd',
		'ᶑ' => 'd',
		'ḏ' => 'd',
		'ᵭ' => 'd',
		'ᶁ' => 'd',
		'đ' => 'd',
		'ɖ' => 'd',
		'ƌ' => 'd',
		'ı' => 'i',
		'ȷ' => 'j',
		'ɟ' => 'j',
		'ʄ' => 'j',
		'ǳ' => 'dz',
		'ǆ' => 'dz',
		'é' => 'e',
		'ĕ' => 'e',
		'ě' => 'e',
		'ȩ' => 'e',
		'ḝ' => 'e',
		'ê' => 'e',
		'ế' => 'e',
		'ệ' => 'e',
		'ề' => 'e',
		'ể' => 'e',
		'ễ' => 'e',
		'ḙ' => 'e',
		'ë' => 'e',
		'ė' => 'e',
		'ẹ' => 'e',
		'ȅ' => 'e',
		'è' => 'e',
		'ẻ' => 'e',
		'ȇ' => 'e',
		'ē' => 'e',
		'ḗ' => 'e',
		'ḕ' => 'e',
		'ⱸ' => 'e',
		'ę' => 'e',
		'ᶒ' => 'e',
		'ɇ' => 'e',
		'ẽ' => 'e',
		'ḛ' => 'e',
		'ꝫ' => 'et',
		'ḟ' => 'f',
		'ƒ' => 'f',
		'ᵮ' => 'f',
		'ᶂ' => 'f',
		'ǵ' => 'g',
		'ğ' => 'g',
		'ǧ' => 'g',
		'ģ' => 'g',
		'ĝ' => 'g',
		'ġ' => 'g',
		'ɠ' => 'g',
		'ḡ' => 'g',
		'ᶃ' => 'g',
		'ǥ' => 'g',
		'ḫ' => 'h',
		'ȟ' => 'h',
		'ḩ' => 'h',
		'ĥ' => 'h',
		'ⱨ' => 'h',
		'ḧ' => 'h',
		'ḣ' => 'h',
		'ḥ' => 'h',
		'ɦ' => 'h',
		'ẖ' => 'h',
		'ħ' => 'h',
		'ƕ' => 'hv',
		'í' => 'i',
		'ĭ' => 'i',
		'ǐ' => 'i',
		'î' => 'i',
		'ï' => 'i',
		'ḯ' => 'i',
		'ị' => 'i',
		'ȉ' => 'i',
		'ì' => 'i',
		'ỉ' => 'i',
		'ȋ' => 'i',
		'ī' => 'i',
		'į' => 'i',
		'ᶖ' => 'i',
		'ɨ' => 'i',
		'ĩ' => 'i',
		'ḭ' => 'i',
		'ꝺ' => 'd',
		'ꝼ' => 'f',
		'ᵹ' => 'g',
		'ꞃ' => 'r',
		'ꞅ' => 's',
		'ꞇ' => 't',
		'ꝭ' => 'is',
		'ǰ' => 'j',
		'ĵ' => 'j',
		'ʝ' => 'j',
		'ɉ' => 'j',
		'ḱ' => 'k',
		'ǩ' => 'k',
		'ķ' => 'k',
		'ⱪ' => 'k',
		'ꝃ' => 'k',
		'ḳ' => 'k',
		'ƙ' => 'k',
		'ḵ' => 'k',
		'ᶄ' => 'k',
		'ꝁ' => 'k',
		'ꝅ' => 'k',
		'ĺ' => 'l',
		'ƚ' => 'l',
		'ɬ' => 'l',
		'ľ' => 'l',
		'ļ' => 'l',
		'ḽ' => 'l',
		'ȴ' => 'l',
		'ḷ' => 'l',
		'ḹ' => 'l',
		'ⱡ' => 'l',
		'ꝉ' => 'l',
		'ḻ' => 'l',
		'ŀ' => 'l',
		'ɫ' => 'l',
		'ᶅ' => 'l',
		'ɭ' => 'l',
		'ł' => 'l',
		'ǉ' => 'lj',
		'ſ' => 's',
		'ẜ' => 's',
		'ẛ' => 's',
		'ẝ' => 's',
		'ḿ' => 'm',
		'ṁ' => 'm',
		'ṃ' => 'm',
		'ɱ' => 'm',
		'ᵯ' => 'm',
		'ᶆ' => 'm',
		'ń' => 'n',
		'ň' => 'n',
		'ņ' => 'n',
		'ṋ' => 'n',
		'ȵ' => 'n',
		'ṅ' => 'n',
		'ṇ' => 'n',
		'ǹ' => 'n',
		'ɲ' => 'n',
		'ṉ' => 'n',
		'ƞ' => 'n',
		'ᵰ' => 'n',
		'ᶇ' => 'n',
		'ɳ' => 'n',
		'ñ' => 'n',
		'ǌ' => 'nj',
		'ó' => 'o',
		'ŏ' => 'o',
		'ǒ' => 'o',
		'ô' => 'o',
		'ố' => 'o',
		'ộ' => 'o',
		'ồ' => 'o',
		'ổ' => 'o',
		'ỗ' => 'o',
		'ö' => 'o',
		'ȫ' => 'o',
		'ȯ' => 'o',
		'ȱ' => 'o',
		'ọ' => 'o',
		'ő' => 'o',
		'ȍ' => 'o',
		'ò' => 'o',
		'ỏ' => 'o',
		'ơ' => 'o',
		'ớ' => 'o',
		'ợ' => 'o',
		'ờ' => 'o',
		'ở' => 'o',
		'ỡ' => 'o',
		'ȏ' => 'o',
		'ꝋ' => 'o',
		'ꝍ' => 'o',
		'ⱺ' => 'o',
		'ō' => 'o',
		'ṓ' => 'o',
		'ṑ' => 'o',
		'ǫ' => 'o',
		'ǭ' => 'o',
		'ø' => 'o',
		'ǿ' => 'o',
		'õ' => 'o',
		'ṍ' => 'o',
		'ṏ' => 'o',
		'ȭ' => 'o',
		'ƣ' => 'oi',
		'ꝏ' => 'oo',
		'ɛ' => 'e',
		'ᶓ' => 'e',
		'ɔ' => 'o',
		'ᶗ' => 'o',
		'ȣ' => 'ou',
		'ṕ' => 'p',
		'ṗ' => 'p',
		'ꝓ' => 'p',
		'ƥ' => 'p',
		'ᵱ' => 'p',
		'ᶈ' => 'p',
		'ꝕ' => 'p',
		'ᵽ' => 'p',
		'ꝑ' => 'p',
		'ꝙ' => 'q',
		'ʠ' => 'q',
		'ɋ' => 'q',
		'ꝗ' => 'q',
		'ŕ' => 'r',
		'ř' => 'r',
		'ŗ' => 'r',
		'ṙ' => 'r',
		'ṛ' => 'r',
		'ṝ' => 'r',
		'ȑ' => 'r',
		'ɾ' => 'r',
		'ᵳ' => 'r',
		'ȓ' => 'r',
		'ṟ' => 'r',
		'ɼ' => 'r',
		'ᵲ' => 'r',
		'ᶉ' => 'r',
		'ɍ' => 'r',
		'ɽ' => 'r',
		'ↄ' => 'c',
		'ꜿ' => 'c',
		'ɘ' => 'e',
		'ɿ' => 'r',
		'ś' => 's',
		'ṥ' => 's',
		'š' => 's',
		'ṧ' => 's',
		'ş' => 's',
		'ŝ' => 's',
		'ș' => 's',
		'ṡ' => 's',
		'ṣ' => 's',
		'ṩ' => 's',
		'ʂ' => 's',
		'ᵴ' => 's',
		'ᶊ' => 's',
		'ȿ' => 's',
		'ɡ' => 'g',
		'ᴑ' => 'o',
		'ᴓ' => 'o',
		'ᴝ' => 'u',
		'ť' => 't',
		'ţ' => 't',
		'ṱ' => 't',
		'ț' => 't',
		'ȶ' => 't',
		'ẗ' => 't',
		'ⱦ' => 't',
		'ṫ' => 't',
		'ṭ' => 't',
		'ƭ' => 't',
		'ṯ' => 't',
		'ᵵ' => 't',
		'ƫ' => 't',
		'ʈ' => 't',
		'ŧ' => 't',
		'ᵺ' => 'th',
		'ɐ' => 'a',
		'ᴂ' => 'ae',
		'ǝ' => 'e',
		'ᵷ' => 'g',
		'ɥ' => 'h',
		'ʮ' => 'h',
		'ʯ' => 'h',
		'ᴉ' => 'i',
		'ʞ' => 'k',
		'ꞁ' => 'l',
		'ɯ' => 'm',
		'ɰ' => 'm',
		'ᴔ' => 'oe',
		'ɹ' => 'r',
		'ɻ' => 'r',
		'ɺ' => 'r',
		'ⱹ' => 'r',
		'ʇ' => 't',
		'ʌ' => 'v',
		'ʍ' => 'w',
		'ʎ' => 'y',
		'ꜩ' => 'tz',
		'ú' => 'u',
		'ŭ' => 'u',
		'ǔ' => 'u',
		'û' => 'u',
		'ṷ' => 'u',
		'ü' => 'u',
		'ǘ' => 'u',
		'ǚ' => 'u',
		'ǜ' => 'u',
		'ǖ' => 'u',
		'ṳ' => 'u',
		'ụ' => 'u',
		'ű' => 'u',
		'ȕ' => 'u',
		'ù' => 'u',
		'ủ' => 'u',
		'ư' => 'u',
		'ứ' => 'u',
		'ự' => 'u',
		'ừ' => 'u',
		'ử' => 'u',
		'ữ' => 'u',
		'ȗ' => 'u',
		'ū' => 'u',
		'ṻ' => 'u',
		'ų' => 'u',
		'ᶙ' => 'u',
		'ů' => 'u',
		'ũ' => 'u',
		'ṹ' => 'u',
		'ṵ' => 'u',
		'ᵫ' => 'ue',
		'ꝸ' => 'um',
		'ⱴ' => 'v',
		'ꝟ' => 'v',
		'ṿ' => 'v',
		'ʋ' => 'v',
		'ᶌ' => 'v',
		'ⱱ' => 'v',
		'ṽ' => 'v',
		'ꝡ' => 'vy',
		'ẃ' => 'w',
		'ŵ' => 'w',
		'ẅ' => 'w',
		'ẇ' => 'w',
		'ẉ' => 'w',
		'ẁ' => 'w',
		'ⱳ' => 'w',
		'ẘ' => 'w',
		'ẍ' => 'x',
		'ẋ' => 'x',
		'ᶍ' => 'x',
		'ý' => 'y',
		'ŷ' => 'y',
		'ÿ' => 'y',
		'ẏ' => 'y',
		'ỵ' => 'y',
		'ỳ' => 'y',
		'ƴ' => 'y',
		'ỷ' => 'y',
		'ỿ' => 'y',
		'ȳ' => 'y',
		'ẙ' => 'y',
		'ɏ' => 'y',
		'ỹ' => 'y',
		'ź' => 'z',
		'ž' => 'z',
		'ẑ' => 'z',
		'ʑ' => 'z',
		'ⱬ' => 'z',
		'ż' => 'z',
		'ẓ' => 'z',
		'ȥ' => 'z',
		'ẕ' => 'z',
		'ᵶ' => 'z',
		'ᶎ' => 'z',
		'ʐ' => 'z',
		'ƶ' => 'z',
		'ɀ' => 'z',
		'ﬀ' => 'ff',
		'ﬃ' => 'ffi',
		'ﬄ' => 'ffl',
		'ﬁ' => 'fi',
		'ﬂ' => 'fl',
		'ĳ' => 'ij',
		'œ' => 'oe',
		'ﬆ' => 'st',
		'ₐ' => 'a',
		'ₑ' => 'e',
		'ᵢ' => 'i',
		'ⱼ' => 'j',
		'ₒ' => 'o',
		'ᵣ' => 'r',
		'ᵤ' => 'u',
		'ᵥ' => 'v',
		'ₓ' => 'x',
		'ß' => 'ss',
		'ẞ' => 'SS'
	);
		
	public static function convertAccentedCharactersToNormalCharacters ($subject)
	{
		$result = '';
		
		$characterLength = XXX_String::getCharacterLength($subject);
		
		if ($characterLength > 0)
		{
			for ($i = 0, $iEnd = $characterLength; $i < $iEnd; ++$i)
			{
				$potentialAccentedCharacter = XXX_String::getPart($subject, $i, 1);
				
				$replacement = self::$accentedCharacterBaseCharacters[$potentialAccentedCharacter];
				
				if ($replacement)
				{
					$result .= $replacement;
				}
				else
				{
					$result .= $potentialAccentedCharacter;
				}
			}
		}
		
		return $result;
	}
	
	public static function simplifyCharacters ($subject)
	{
		$subject = XXX_String::convertAccentedCharactersToNormalCharacters($subject);
		$subject = XXX_String::convertToLowerCase($subject);
		
		return $subject;
	}
	
	// Without accents and case-insensitive
	public static function isSimplifiedIdentical ($a, $b)
	{
		$result = (self::simplifyCharacters($a) == self::simplifyCharacters($b));
		
		return $result;
	}
}

?>
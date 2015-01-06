<?php

/*

Messy sample data:
browserName, browserAlias, 5446.545e12
"Inter,net \"Explorer", Something,564458
5ED38874.cm-7-4c.dynamic.ziggo.nl,94.211.136.116
host,ip
   work.com   ,,hjhjk,
home.net,, -5667567 ,
123, someOtherValue
  1234e-10, someOtherValue
, (Empty)
"Hello", someOtherValue
"Hello there", someOtherValue
"Hello \" a\nd, so there" , someOtherValue
'Hello', someOtherValue
'Hello there', someOtherValue
'Hello \' and, so there' ,  someOtherValue
Hello,  someOtherValue
Hello there, someOtherValue


Delimiter: , or ;
Enclosure: ' "
Escape \' \"

*/

abstract class XXX_String_CSV
{
	const CLASS_NAME = 'XXX_String_CSV';
	
	public static function compose ($array, $glue = ',', $useCommaForNumbers = false, $emptyValue = 'X')
	{
		$result = false;
		
		$rowTotal = XXX_Array::getFirstLevelItemTotal($array);
		
		if ($rowTotal > 0 && XXX_Array::getDeepestLevel($array) == 2)
		{
			$columnTotal = XXX_Array::getFirstLevelItemTotal($array[0]);
			
			$result = '';
			
			for ($i = 0, $iEnd = $rowTotal; $i < $iEnd; ++$i)
			{
				for ($j = 0, $jEnd = $columnTotal; $j < $jEnd; ++$j)
				{
					$value = $array[$i][$j];
					
					if ($j > 0)
					{
						$result .= $glue;
					}
					
					$result .= self::formatValue($value, $useCommaForNumbers, $emptyValue);
				}
				
				$result .= XXX_String::$lineSeparator;
			}
		}
		else
		{
			// Array should have rows and be 2 levels deep [row][column]
		}
		
		return $result;
	}
	
	public static function formatValue ($value = '', $useCommaForNumbers = false, $emptyValue = 'X')
	{
		$result = '';
		
		if (XXX_Type::isEmpty($value))
		{
			$result = $emptyValue;
		}
		else if (XXX_Type::isString($value) && XXX_String::findFirstPosition($value, ' ') !== false)
		{
			$result .= '"' . XXX_String::addSlashes($value) . '"';
		}
		else if (XXX_Type::isBoolean($value))
		{
			$result .= $value ? 'true' : 'false';
		}
		else
		{
			if (XXX_Type::isNumber($value) && $useCommaForNumbers)
			{
				$result .= XXX_String::replace($value, '.', ',');
			}
			else
			{
				$result .= $value;
			}
		}
		
		return $result;
	}
	
	public static function parse ($raw, $separator = ',')
	{
		$raw = XXX_String::normalizeLineSeparators($raw);
		
		$lines = XXX_String::splitToArray($raw, XXX_String::$lineSeparator);
		
		$parsedLines = self::parseLines($lines, $separator);
		
		$parsedLines = self::balanceColumns($parsedLines);
		
		return $parsedLines;
	}
	
	public static function sortColumnAscending ($a, $b)
	{
		$result = 0;
		
		if ($a[1] < $b[1])
		{
			$result = -1;
		}
		else if ($a[1] > $b[1])
		{
			$result = 1;
		}
		
		return $result;
	}
	
	public static function sortColumnDescending ($a, $b)
	{
		$result = 0;
		
		if ($a[1] < $b[1])
		{
			$result = 1;
		}
		else if ($a[1] > $b[1])
		{
			$result = -1;
		}
		
		return $result;
	}
	
	public static function sortByColumn ($csvArray = array(), $sortColumn = 0, $order = 'ascending', $avoidFirstRow = true)
	{
		$i = 0;
		
		if ($avoidFirstRow)
		{
			$i = 1;
		}
		
		$columnSortingArray = array();
		
		for ($iEnd = XXX_Array::getFirstLevelItemTotal($csvArray); $i < $iEnd; ++$i)
		{
			$columnSortingArray[] = array($i, $csvArray[$i][$sortColumn]);
		}
		
		if ($order == 'ascending')
		{
			usort($columnSortingArray, 'XXX_String_CSV::sortColumnAscending');
		}
		else
		{
			usort($columnSortingArray, 'XXX_String_CSV::sortColumnDescending');
		}
		
		$sortedCSVArray = array();
		
		if ($avoidFirstRow)
		{
			$sortedCSVArray[] = $csvArray[0];
		}
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($columnSortingArray); $i < $iEnd; ++$i)
		{
			$sortedCSVArray[] = $csvArray[$columnSortingArray[$i][0]];
		}
		
		return $sortedCSVArray;
	}
	
	public static function parseLines ($lines, $separator = ',')
	{
		$parsedLines = array();
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($lines); $i < $iEnd; ++$i)
		{
			if ($lines[$i] != '')
			{
				$parsedLines[$i] = self::parseLine($lines[$i], $separator);
			}
		}
		
		return $parsedLines;
	}
	
	public static function parseLine ($line = '', $separator = ',')
	{
		// u pattern modifier doesn't work correctly...
		
		$matches = XXX_String_Pattern::getMatches($line, '(?<=^|' . XXX_String_Pattern::escape($separator) . ')(?:\\s*(?:"((?:[^\\\\"]|\\\\"|\\\\)*)"|\'((?:[^\\\\"]|\\\\\'|\\\\)*)\'|(-?[0-9]+(?:\\.[0-9]+)?(?:[eE][-+]?[0-9]+)?)|([^' . XXX_String_Pattern::escape($separator) . ']+)|)\\s*)(?=$|' . XXX_String_Pattern::escape($separator) . ')', 'im');
		
		
    	$matchesTotal = XXX_Array::getFirstLevelItemTotal($matches[0]);
    	
    	$parsedLine = array();
    	
    	for ($j = 0, $jEnd = $matchesTotal; $j < $jEnd; ++$j)
    	{
    		$value = null;
    		
    		if (XXX_String::trim($matches[1][$j]) != '')
    		{
    			$value = XXX_String::removeSlashes(XXX_String::trim($matches[1][$j]));
    		}
    		else if (XXX_String::trim($matches[2][$j]) != '')
    		{
    			$value = XXX_String::removeSlashes(XXX_String::trim($matches[2][$j]));
    		}
    		else if (XXX_String::trim($matches[3][$j]) != '')
    		{
    			$value = XXX_Type::makeNumber(XXX_String::trim($matches[3][$j]));
    		}
    		else if (XXX_String::trim($matches[4][$j]) != '')
    		{
    			$value = XXX_String::removeSlashes(XXX_String::trim($matches[4][$j]));
    		}
    		
    		if ($value === 'false' || $value === 'FALSE')
    		{
    			$value = false;
    		}
    		else if ($value === 'true' || $value === 'TRUE')
    		{
    			$value = true;
    		}
    		    		
    		$parsedLine[] = $value;
    	}
    			
    	return $parsedLine;
	}
	
	public static function balanceColumns ($parsedLines, $balanceValue = false)
	{
		$columns = 0;
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($parsedLines); $i < $iEnd; ++$i)
	    {
	    	$temp = XXX_Array::getFirstLevelItemTotal($parsedLines[$i]);
	    	
	    	if ($temp > $columns)
	    	{
	    		$columns = $temp;
	    	}
	    }
		
		
		// Balance columns
	    for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($parsedLines); $i < $iEnd; ++$i)
	    {
	    	for ($j = 0, $jEnd = $columns; $j < $jEnd; ++$j)
	    	{
	    		if (!isset($parsedLines[$i][$j]))
	    		{
	    			$parsedLines[$i][$j] = $balanceValue;
	    		}
	    	}
	    }
	    
	    return $parsedLines;
	}
	
	public static function distributeCSVFileOverSmallerCSVFiles ($csvFile = '', $maximumFileSize = 104857600, $maximumLines = 1048575)
	{
		$csvFileIdentifier = XXX_Path_Local::getIdentifier($csvFile);
		$csvFileParentPath = XXX_Path_Local::getParentPath($csvFile);
		
		$readFile = $csvFile;
		
		$filesWritten = 0;
		
		$bytesWritten = 0;
		
		$linesWritten = 0;
		
		$lineCount = 0;
		
		$headerLine = '';
		
		$readHandle = fopen($readFile, 'r');
		fseek($readHandle, 0);
		
		while (!feof($readHandle))
		{
			$line = fgets($readHandle);
			
			$line = trim($line);
			
			if ($bytesWritten == 0 || $bytesWritten > $maximumFileSize || $linesWritten > $maximumLines)
			{
				$bytesWritten = 0;
				
				$filesWritten += 1;
				
				$linesWritten = 0;
				
				if ($writeHandle)
				{
					fclose($writeHandle);
				}
				
				$writeFile = XXX_Path_Local::extendPath($csvFileParentPath, array('part.' . $filesWritten . '.' . $csvFileIdentifier));
				
				$writeHandle = fopen($writeFile, 'w');
				
				if ($bytesWritten == 0 && $filesWritten == 1)
				{
					$headerLine = $line;
				}
				
				if ($filesWritten > 1)
				{
					fputs($writeHandle, $headerLine . XXX_String::$lineSeparator);
				}
			}
			
			fputs($writeHandle, $line . XXX_String::$lineSeparator);
			
			$bytesWritten += strlen($line);
			$linesWritten += 1;
			
			++$lineCount;
		}
		
		fclose($readHandle);
		
		if ($writeHandle)
		{
			fclose($writeHandle);
		}
		
		return $lineCount;
	}
}

?>
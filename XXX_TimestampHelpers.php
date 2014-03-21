<?php


abstract class XXX_TimestampHelpers
{
	// January 1st 2012 midnight NYE, seconds since unix epoch (Used as the VTH Epoch)
	public static $unixEpochRelativeTimestampOffset = 1325376000;
	
	// 4.398.046.511.103 (~ 139 Years) (42 bits)
	public static $maximumRelativeMillisecondTimestamp = 4398046511103;
	// See above
	public static $maximumRelativeTimestamp = 4398046511;
	
	
	// Absolute
	
		public static function getCurrentTimestamp ()
		{
			return time();
		}
		
		public static function getCurrentSecondTimestamp ()
		{
			return time();
		}
		
		public static function getCurrentMillisecondTimestamp ()
		{
			return round(microtime(true) * 1000);
		}
		
		public static function getCurrentYear ()
		{
			return XXX_Type::makeInteger(date('Y'));
		}
		
		public static function getCurrentMonth ()
		{
			return XXX_Type::makeInteger(date('n'));
		}
		
		public static function getCurrentDate ()
		{
			return XXX_Type::makeInteger(date('j'));
		}
		
		public static function getCurrentDayOfTheWeek ()
		{
			$result = XXX_Type::makeInteger(date('w'));
			
			if ($result === 0)
			{
				$result = 7;
			}
			
			return $result;
		}
		
		public static function getTimestampPartForFile ($short = false)
		{
			$timestamp = new XXX_Timestamp();
		
			$parts = $timestamp->parse();
			
			if ($short)
			{
				$timestampPart = $parts['year'] . '_' . XXX_String::padLeft($parts['month'], '0', 2) . '_' . XXX_String::padLeft($parts['dayOfTheMonth'], '0', 2);
			}
			else
			{
				$timestampPart = $parts['year'] . '_' . XXX_String::padLeft($parts['month'], '0', 2) . '_' . XXX_String::padLeft($parts['dayOfTheMonth'], '0', 2) . 'T' . XXX_String::padLeft($parts['hour'], '0', 2) . '_' . XXX_String::padLeft($parts['minute'], '0', 2) . '_' . XXX_String::padLeft($parts['second'], '0', 2) . 'Z';
			}
			
			return $timestampPart;
		}
		
		public static function getTimestampPartsForPath ()
		{
			$timestamp = new XXX_Timestamp();
			
			$result = $timestamp->parse();
			
			return $result;
		}
	
	// Relative
		
		// get
			
			public static function getCurrentRelativeTimestamp ()
			{
				$result = false;
				
				$now = XXX_TimestampHelpers::getCurrentTimestamp() - self::$unixEpochRelativeTimestampOffset;
				
				if ($now <= self::$maximumRelativeTimestamp)
				{
					$result = $now;
				}
				
				return $result;
			}
			
			public static function getCurrentSecondRelativeTimestamp ()
			{
				return self::getCurrentRelativeTimestamp();
			}
			
			public static function getCurrentRelativeMillisecondTimestamp ()
			{
				$result = false;
				
				$now = XXX_TimestampHelpers::getCurrentMillisecondTimestamp() - (self::$unixEpochRelativeTimestampOffset * 1000);
				
				if ($now <= self::$maximumRelativeMillisecondTimestamp)
				{
					$result = $now;
				}
				
				return $result;
			}
		
		// convert
		
			public static function makeAbsoluteTimestampRelative ($absoluteTimestamp = 0)
			{
				$relativeTimestamp = $absoluteTimestamp - self::$unixEpochRelativeTimestampOffset;
				
				return $relativeTimestamp;
			}
			
			public static function makeAbsoluteSecondTimestampRelative ($absoluteSecondTimestamp = 0)
			{
				return self::makeAbsoluteTimestampRelative($absoluteSecondTimestamp);
			}
			
			public static function makeAbsoluteMillisecondTimestampRelative ($absoluteMillisecondTimestamp = 0)
			{
				$relativeMillisecondTimestamp = $absoluteMillisecondTimestamp - (self::$unixEpochRelativeTimestampOffset * 1000);
				
				return $relativeMillisecondTimestamp;
			}
			
			public static function makeRelativeTimestampAbsolute ($relativeTimestamp = 0)
			{
				$absoluteTimestamp = self::$unixEpochRelativeTimestampOffset + $relativeTimestamp;
				
				return $absoluteTimestamp;
			}
			
			public static function makeRelativeSecondTimestampAbsolute ($relativeSecondTimestamp = 0)
			{
				return self::makeRelativeTimestampAbsolute($relativeSecondTimestamp);
			}
			
			public static function makeRelativeMillisecondTimestampAbsolute ($relativeMillisecondTimestamp = 0)
			{
				$absoluteMillisecondTimestamp = (self::$unixEpochRelativeTimestampOffset * 1000) + $relativeMillisecondTimestamp;
				
				return $absoluteMillisecondTimestamp;
			}
		
		// valid
		
			public static function isValidRelativeTimestamp ($relativeTimestamp = false)
			{
				$result = false;
				
				if ($relativeTimestamp === false)
				{
					$relativeTimestamp = self::getCurrentRelativeTimestamp();
				}
					
				if ($relativeTimestamp <= self::$maximumRelativeTimestamp)
				{
					$result = true;
				}
				
				return $result;
			}
			
			public static function isValidRelativeSecondTimestamp ($relativeSecondTimestamp = false)
			{
				return self::isValidRelativeTimestamp($relativeSecondTimestamp = false);
			}
			
			public static function isValidRelativeMillisecondTimestamp ($relativeMillisecondTimestamp = false)
			{
				$result = false;
				
				if ($relativeMillisecondTimestamp === false)
				{
					$relativeMillisecondTimestamp = self::getCurrentRelativeMillisecondTimestamp();
				}
					
				if ($relativeMillisecondTimestamp <= self::$maximumRelativeMillisecondTimestamp)
				{
					$result = true;
				}
				
				return $result;
			}
			
	
	public static function getYearAndMonthByMonthOffset ($year, $month, $monthOffset)
	{
		$result = array
		(
			'year' => $year,
			'month' => $month
		);
		
		if ($monthOffset == 1)
		{
			if ($month == 12)
			{
				$result = array
				(
					'year' => $year + 1,
					'month' => 1
				);
			}
			else
			{
				$result = array
				(
					'year' => $year,
					'month' => $month + 1
				);
			}
		}
		else if ($monthOffset == -1)
		{
			if ($month == 1)
			{
				$result = array
				(
					'year' => $year - 1,
					'month' => 12
				);
			}
			else
			{
				$result = array
				(
					'year' => $year,
					'month' => $month - 1
				);
			}
		}
		else
		{
			// TODO
		}
		
		return $result;
	}
	
	/*
	
	1. Offset by 1 month forward
	2. Reset the date (day of the month) to 0 (Which is a trick, and actually sets it to the last date in the month before)
	3. Read out the current date 
	
	*/
	
	// 28 - 31
	public static function getDayTotalInMonth ($year, $month)
	{
		$offsetYearAndMonth = self::getYearAndMonthByMonthOffset($year, $month, 1);
		
		$timestamp = mktime(1, 1, 1, $month, 1, $year);
		
		$dayTotalInMonth = date('t', $timestamp);
		
		$result = $dayTotalInMonth;
		
		return $result;
	}
	
	/*
	
	http://en.wikipedia.org/wiki/Leap_year
	
	*/
	
	public static function isLeapYear ($year)
	{
		$result = false;
		
		if ($year % 4 === 0)
		{
			if ($year % 100 === 0)
			{
				if ($year % 400 === 0)
				{
					$result = true;
				}
				else
				{
					$result = false;
				}
			}
			else
			{
				$result = true;
			}
		}
		else
		{
			$result = false;
		}
		
		return $result;
	}
	
	// 365 - 366
	public static function getDayTotalInYear ($year)
	{
		$daysTotal = 365;
		
		if (self::isLeapYear($year))
		{
			++$daysTotal;
		}
		
		return $daysTotal;
	}
	
	// NOT according to ISO 8601, but from January 1st
	
	// 1 - 366
	public static function getDayOfTheYear ($year, $month, $date)
	{
		/*
		
		January 31
		February 28/29
		March 31
		April 30
		May 31
		June 30
		July 31
		August 31
		September 30
		October 31
		November 30
		December 31
				 
		*/
		
		$dayOffsetInMonths = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
		
		$dayOfTheYear = $date + $dayOffsetInMonths[$month - 1];
   
		if (self::isLeapYear($year))
		{
			if ($month > 2)
			{
				++$dayOfTheYear;
			}
		}
	   
		return $dayOfTheYear;
	}
	
	// Exists
	
		public static function isExistingDate ($year, $month, $date)
		{
			$result = false;
			
			$dayTotalInMonth = self::getDayTotalInMonth($year, $month);
			
			if (($month >= 1 && $month <= 12) && ($date <= $dayTotalInMonth))
			{
				$result = true;	
			}
			
			return $result;
		}
		
		public static function isExistingTime ($hour, $minute)
		{
			$result = false;
			
			if ($hour >= 0 && $hour <= 23 && $minute >= 0 && $minute <= 59)
			{
				$result = true;
			}
			
			return $result;
		}
	
	// ISO 8601 - http://www.personal.ecu.edu/mccartyr/isowdcal.html
	
	
	// 1. Weeks start on monday
	// 2. The first week of the year is the week with the first thursday in it.
	
		public static function iso8601_getFirstMondayOfTheYear ($year)
		{
			$result = array();
			
			// January 1st in that year
			$tempTimestamp = new XXX_Timestamp(array('year' => $year, 'month' => 1, 'date' => 1));
			
			$parts = $tempTimestamp->parse();
			
			// January 1st is a:
			switch ($parts['dayOfTheWeek'])
			{
				// Monday (Week 1 starts on Monday January 1st that year)
				case 1:
					$result = array
					(
						'year' => $year,
						'month' => 1,
						'date' => 1
					);
					break;
				// Tuesday (Week 1 starts on Monday December 31st the previous year)
				case 2:
					$result = array
					(
						'year' => $year - 1,
						'month' => 12,
						'date' => 31
					);
					break;
				// Wednesday (Week 1 starts on Monday December 30th the previous year)
				case 3:
					$result = array
					(
						'year' => $year - 1,
						'month' => 12,
						'date' => 30
					);
					break;
				// Thursday (Week 1 starts on Monday December 29th the previous year)
				case 4:
					$result = array
					(
						'year' => $year - 1,
						'month' => 12,
						'date' => 29
					);
					break;
				// Friday (Week 1 starts on Monday January 4th that year)
				case 5:
					$result = array
					(
						'year' => $year,
						'month' => 1,
						'date' => 4
					);
					break;
				// Saturday (Week 1 starts on Monday January 3rd that year)
				case 6:
					$result = array
					(
						'year' => $year,
						'month' => 1,
						'date' => 3
					);
					break;
				// Sunday (Week 1 starts on Monday January 2nd that year)
				case 7:
					$result = array
					(
						'year' => $year,
						'month' => 1,
						'date' => 2
					);
					break;
			}
			
			return $result;
		}
		
		public static function iso8601_getLastMondayOfTheYear ($year)
		{
			$firstMondayOfTheNextYear = self::iso8601_getFirstMondayOfTheYear($year + 1);
			
			$result = array();
			
			// January 1st in that year
			$tempTimestamp = new XXX_Timestamp(array('year' => $firstMondayOfTheNextYear['year'], 'month' => $firstMondayOfTheNextYear['month'], 'date' => $firstMondayOfTheNextYear['date']));
			
			$parts = $tempTimestamp->parse();
			
			// All back 1 week
			switch ($parts['date'])
			{
				case 29:
					$result = array
					(
						'year' => $firstMondayOfTheNextYear['year'],
						'month' => 12,
						'date' => 22
					);
					break;
				case 30:
					$result = array
					(
						'year' => $firstMondayOfTheNextYear['year'],
						'month' => 12,
						'date' => 23
					);
					break;
				case 31:
					$result = array
					(
						'year' => $firstMondayOfTheNextYear['year'],
						'month' => 12,
						'date' => 24
					);
					break;
				case 1:
					$result = array
					(
						'year' => $firstMondayOfTheNextYear['year'] - 1,
						'month' => 12,
						'date' => 25
					);
					break;
				case 2:
					$result = array
					(
						'year' => $firstMondayOfTheNextYear['year'] - 1,
						'month' => 12,
						'date' => 26
					);
					break;
				case 3:
					$result = array
					(
						'year' => $firstMondayOfTheNextYear['year'] - 1,
						'month' => 12,
						'date' => 27
					);
					break;
				case 4:
					$result = array
					(
						'year' => $firstMondayOfTheNextYear['year'] - 1,
						'month' => 12,
						'date' => 28
					);
					break;
			}
			
			return $result;
		}
		
		// 1 - 52 / 53
		public static function iso8601_getWeekOfTheYear ($year, $month, $date)
		{
			$firstMondayOfTheYear = self::iso8601_getFirstMondayOfTheYear($year);
			$lastMondayOfThePreviousYear = self::iso8601_getLastMondayOfTheYear($year - 1);
			$firstMondayOfTheNextYear = self::iso8601_getFirstMondayOfTheYear($year + 1);
			
			$weekOfTheYear = 0;
			
			// Given date is before first monday of the year
			if ($year == $firstMondayOfTheYear['year'] && $month == $firstMondayOfTheYear['month'] && $date < $firstMondayOfTheYear['date'])
			{
				// Last week of the previous year
					
					$weekOfTheYear = self::iso8601_getWeekOfTheYear($lastMondayOfThePreviousYear['year'], $lastMondayOfThePreviousYear['month'], $lastMondayOfThePreviousYear['date']);
			}
			// Given date is after or equal to first monday of the next year
			else if ($year == $firstMondayOfTheNextYear['year'] && $month == $firstMondayOfTheNextYear['month'] && $date >= $firstMondayOfTheNextYear['date'])
			{
				// Week 1 of the next year
				
					$weekOfTheYear = 1;
			}
			else
			{
				$dayOfTheYear = self::getDayOfTheYear($year, $month, $date);
				
				$daysSinceFirstMondayOfTheYear = $dayOfTheYear - 1;
				
				if ($firstMondayOfTheYear['year'] < $year)
				{
					// In relation to December which always has 31 days
					$daysSinceFirstMondayOfTheYear += (32 - $firstMondayOfTheYear['date']);
				}
				else
				{
					$daysSinceFirstMondayOfTheYear -= ($firstMondayOfTheYear['date'] - 1);
				}
				
				$weekOfTheYear = XXX_Number::floor($daysSinceFirstMondayOfTheYear / 7) + 1;
			}
						
			return $weekOfTheYear;
		}
		
		// 52 / 53
		public static function iso8601_getWeekTotalInYear ($year)
		{
			$lastMondayOfTheYear = self::iso8601_getLastMondayOfTheYear($year);
			
			$weekOfTheYear = self::iso8601_getWeekOfTheYear($lastMondayOfTheYear['year'], $lastMondayOfTheYear['month'], $lastMondayOfTheYear['date']);
			
			$result = $weekOfTheYear;
			
			return $result;
		}
	
	
	////////////////////
	// TimeZone & DST
	////////////////////
	
		public static function getLocalSecondOffset ($timeZoneSecondOffset = false, $daylightSavingTime = false)
		{
			$localSecondOffset = 0;
			
			
			if (XXX_Type::isInteger($timeZoneSecondOffset))
			{
				$localSecondOffset += $timeZoneSecondOffset;
				
				if ($daylightSavingTime)
				{
					$localSecondOffset += 3600;
				}
			}
			
			
			return $localSecondOffset;
		}
			
	////////////////////
	// Month array
	////////////////////
	
	public static function getMonthArray ($year, $month, $weekStart = 'monday')
	{
		if (!($weekStart == 'monday' || $weekStart == 'sunday'))
		{
			$weekStart = 'monday';
		}
		
		$currentMonth = array
		(
			'year' => $year,
			'month' => $month
		);
		$previousMonth = self::getYearAndMonthByMonthOffset($year, $month, -1);
		$nextMonth = self::getYearAndMonthByMonthOffset($year, $month, 1);
		
		$currentMonthDayTotalInMonth = self::getDayTotalInMonth($currentMonth['year'], $currentMonth['month']);
		$previousMonthDayTotalInMonth = self::getDayTotalInMonth($previousMonth['year'], $previousMonth['month']);
		
		$firstDayOfTheMonthTimestamp = new XXX_Timestamp(array('year' => $currentMonth['year'], 'month' => $currentMonth['month'], 'date' => 1));
		$lastDayOfTheMonthTimestamp = new XXX_Timestamp(array('year' => $currentMonth['year'], 'month' => $currentMonth['month'], 'date' => $currentMonthDayTotalInMonth));
				
		$firstDayOfTheMonthDateParts = $firstDayOfTheMonthTimestamp->parse();
		$lastDayOfTheMonthDateParts = $lastDayOfTheMonthTimestamp->parse();
		
		$paddingDaysInPreviousMonth = 0;
		$paddingDaysInNextMonth = 0;
		
		if ($weekStart == 'monday')
		{
			$paddingDaysInPreviousMonth = $firstDayOfTheMonthDateParts['dayOfTheWeek'] - 1;
			$paddingDaysInNextMonth = 7 - $lastDayOfTheMonthDateParts['dayOfTheWeek'];
			
			switch ($firstDayOfTheMonthDateParts['dayOfTheWeek'])
			{
				// Sunday
				case 7:
					$paddingDaysInPreviousMonth = 6;
					break;
				// Saturday
				case 6:
					$paddingDaysInPreviousMonth = 5;
					break;
				// Friday
				case 5:
					$paddingDaysInPreviousMonth = 4;
					break;
				// Thursday
				case 4:
					$paddingDaysInPreviousMonth = 3;
					break;
				// Wednesday
				case 3:
					$paddingDaysInPreviousMonth = 2;
					break;
				// Tuestday
				case 2:
					$paddingDaysInPreviousMonth = 1;
					break;
				// Monday
				case 1:
					$paddingDaysInPreviousMonth = 7;
					break;
			}
						
			switch ($lastDayOfTheMonthDateParts['dayOfTheWeek'])
			{
				// Sunday
				case 7:
					$paddingDaysInNextMonth = 7;
					break;
				// Saturday
				case 6:
					$paddingDaysInNextMonth = 1;
					break;
				// Friday
				case 5:
					$paddingDaysInNextMonth = 2;
					break;
				// Thursday
				case 4:
					$paddingDaysInNextMonth = 3;
					break;
				// Wednesday
				case 3:
					$paddingDaysInNextMonth = 4;
					break;
				// Tuesday
				case 2:
					$paddingDaysInNextMonth = 5;
					break;
				// Monday
				case 1:
					$paddingDaysInNextMonth = 6;
					break;
			}
		}
		else if ($weekStart == 'sunday')
		{
			switch ($firstDayOfTheMonthDateParts['dayOfTheWeek'])
			{
				// Sunday
				case 7:
					$paddingDaysInPreviousMonth = 7;
					break;
				// Saturday
				case 6:
					$paddingDaysInPreviousMonth = 6;
					break;
				// Friday
				case 5:
					$paddingDaysInPreviousMonth = 5;
					break;
				// Thursday
				case 4:
					$paddingDaysInPreviousMonth = 4;
					break;
				// Wednesday
				case 3:
					$paddingDaysInPreviousMonth = 3;
					break;
				// Tuestday
				case 2:
					$paddingDaysInPreviousMonth = 2;
					break;
				// Monday
				case 1:
					$paddingDaysInPreviousMonth = 1;
					break;
			}
						
			switch ($lastDayOfTheMonthDateParts['dayOfTheWeek'])
			{
				// Sunday
				case 7:
					$paddingDaysInNextMonth = 6;
					break;
				// Saturday
				case 6:
					$paddingDaysInNextMonth = 7;
					break;
				// Friday
				case 5:
					$paddingDaysInNextMonth = 1;
					break;
				// Thursday
				case 4:
					$paddingDaysInNextMonth = 2;
					break;
				// Wednesday
				case 3:
					$paddingDaysInNextMonth = 3;
					break;
				// Tuesday
				case 2:
					$paddingDaysInNextMonth = 4;
					break;
				// Monday
				case 1:
					$paddingDaysInNextMonth = 5;
					break;
			}
		}
				
		$result = array();
				
		// Days in the previous month
		for ($dayInPreviousMonth = (($previousMonthDayTotalInMonth + 1) - $paddingDaysInPreviousMonth); $dayInPreviousMonth <= $previousMonthDayTotalInMonth; ++$dayInPreviousMonth)
		{			
			$result[] = array('type' => 'previous', 'year' => $previousMonth['year'], 'month' => $previousMonth['month'], 'date' => $dayInPreviousMonth);
		}
		// Days in the month
		for ($day = 1; $day <= $currentMonthDayTotalInMonth; ++$day)
		{
			$result[] = array('type' => 'current', 'year' => $year, 'month' => $month, 'date' => $day);
		}
		
		// Days in the next month
		for ($dayInNextMonth = 1; $dayInNextMonth <= $paddingDaysInNextMonth; ++$dayInNextMonth)
		{
			$result[] = array('type' => 'next', 'year' => $nextMonth['year'], 'month' => $nextMonth['month'], 'date' => $dayInNextMonth);
		}
		
		// Prefix a row with daysOfTheWeek
		
			$newResult = array();
		
			$newResult[] = 'w';
			
			if ($weekStart == 'monday')
			{
				$newResult[] = 1;
				$newResult[] = 2;
				$newResult[] = 3;
				$newResult[] = 4;
				$newResult[] = 5;
				$newResult[] = 6;
				$newResult[] = 7;
			}
			else if ($weekStart == 'sunday')
			{
				$newResult[] = 7;
				$newResult[] = 1;
				$newResult[] = 2;
				$newResult[] = 3;
				$newResult[] = 4;
				$newResult[] = 5;
				$newResult[] = 6;
			}
			
		// Prefix the weekOfTheYear
		
			// It's always 7 or a multiple of 7
			$rows = XXX_Array::getFirstLevelItemTotal($result) / 7;
						
			for ($i = 0, $iEnd = $rows; $i < $iEnd; ++$i)
			{
				$k = $i * 7;
				
				$tempRecord = $result[$k + 1];
				
				$weekOfTheYear = XXX_TimestampHelpers::iso8601_getWeekOfTheYear($tempRecord['year'], $tempRecord['month'], $tempRecord['date']);
				
				$newResult[] = array('type' => 'weekOfTheYear', 'weekOfTheYear' => $weekOfTheYear);
				
				for ($j = 0, $jEnd = 7; $j < $jEnd; ++$j)
				{
					$tempRecord = $result[$k + $j];
					
					$newResult[] = $tempRecord;
				}
			}
			
			$result = $newResult;
						
		return $result;
	}
	
	////////////////////
	// Difference
	////////////////////
	
	public static function getDifference ($firstTime, $secondTime)
	{		
		$difference = 0;
		
		$positive = true;
		
		if ($firstTime < $secondTime)
		{
			$difference = $secondTime - $firstTime;
			$positive = true;
		}
		else
		{
			$difference = $firstTime - $secondTime;
			$positive = false;
		}
		
		$dayDifferenceTotal = $difference / 86400;
		$hourDifferenceTotal = $difference / 3600;
		$minuteDifferenceTotal = $difference / 60;
		$secondDifferenceTotal = $difference;
		
		$dayDifferenceByRemainder = XXX_Number::floor($difference / 86400);
		$difference -= ($dayDifferenceByRemainder * 86400);
		
		$hourDifferenceByRemainder = XXX_Number::floor($difference / 3600);
		$difference -= ($hourDifferenceByRemainder * 3600);
		
		$minuteDifferenceByRemainder = XXX_Number::floor($difference / 60);
		$difference -= ($minuteDifferenceByRemainder * 60);
		
		$secondDifferenceByRemainder = $difference;
		
		$difference = array
		(
			'positive' => $positive,
			'total' => array
			(
				'day' => $dayDifferenceTotal,
				'hour' => $hourDifferenceTotal,
				'minute' => $minuteDifferenceTotal,
				'second' => $secondDifferenceTotal
			),
			'remainder' => array
			(
				'day' => $dayDifferenceByRemainder,
				'hour' => $hourDifferenceByRemainder,
				'minute' => $minuteDifferenceByRemainder,
				'second' => $secondDifferenceByRemainder
			)
		);
		
		return $difference;
	}
	
	////////////////////
	// Age
	////////////////////
	
	// Years
	public static function getDateOfBirthYearAge ($year, $month, $date)
	{
		$result = 0;
		
		if (self::isExistingDate($year, $month, $date))
		{
			$timestamp = new XXX_Timestamp(XXX_TimestampHelpers::getCurrentSecondTimestamp());
			$parts = $timestamp->parse();
						
			$yearNow = $parts['year'];
			$monthNow = $parts['month'];
			$dateNow = $parts['date'];
			
			
			$yearDifference = $yearNow - $year;
			$monthDifference = $monthNow - $month;
			$dateDifference = $dateNow - $date;
			
			if ($monthDifference < 0)
			{
				--$yearDifference;
			}	
			else if ($monthDifference == 0 && $dateDifference < 0)
			{
				--$yearDifference;
			}
			
			$yearDifference = XXX_Default::toPositiveInteger($yearDifference, 0);
			
			$result = $yearDifference;
		}
		
		return $result;
	}
	
	
	////////////////////
	// MySQL
	////////////////////
	
	public static function convertToMySQLTimestamp ($timestamp)
	{
		$timestamp = new XXX_Timestamp($timestamp);
		
		$parts = $timestamp->parse();
		
		$result = XXX_String::padLeft($parts['year'], '0', 4) . '-' . XXX_String::padLeft($parts['month'], '0', 2) . '-' . XXX_String::padLeft($parts['date'], '0', 2) . ' ' . XXX_String::padLeft($parts['hour'], '0', 2) . ':' . XXX_String::padLeft($parts['minute'], '0', 2) . ':' . XXX_String::padLeft($date['second'], '0', 2);
		
		return $result;
	}
	
	public static function convertMySQLTimestampToDate ($timestamp)
	{
		// Defaults
		$year = 0;	
		$month = 0;
		$date = 1;
		$hour = 0;
		$minute = 0;
		$second = 0;
		
		$offset = 0;
		
		$timestampLength = XXX_String::getByteSize($timestamp);
		
		// Negative dates
		if (XXX_String::getPart($timestamp, 0, 1) == '-')
		{
			$offset = 1;	
		}
		
		if ($timestampLength >= $offset + 4)
		{
			$year = XXX_Type::makeInteger(XXX_String::getPart($timestamp, $offset, 4));
			
			if ($offset == 1)
			{
				$year *= -1;	
			}
		}
		
		if ($timestampLength >= $offset + 7)
		{
			$month = XXX_Type::makeInteger(XXX_String::getPart($timestamp, $offset + 5, 2));
		}
		
		if ($timestampLength >= $offset + 10)
		{
			$date = XXX_Type::makeInteger(XXX_String::getPart($timestamp, $offset + 8, 2));
		}
		if ($timestampLength >= $offset + 13)
		{
			$hour = XXX_Type::makeInteger(XXX_String::getPart($timestamp, $offset + 11, 2));
		}
		if ($timestampLength >= $offset + 16)
		{
			$minute = XXX_Type::makeInteger(XXX_String::getPart($timestamp, $offset + 14, 2));
		}
		if ($timestampLength >= $offset + 19)
		{
			$second = XXX_Type::makeInteger(XXX_String::getPart($timestamp, $offset + 17, 2));
		}
		
		$tempTimestamp = new XXX_Timestamp(array('year' => $year, 'month' => $month, 'date' => $date, 'hour' => $hour, 'minute' => $minute, 'second' => $second));
				
		return $tempTimestamp;
	}
	
	
	public static function convertTimestampStringToTimestamp ($timestampString = '')
	{
		$result = strtotime($timestampString);
		
		if ($result === false)
		{
			// 2012 Sep 25 00:54:02
			// Sep 25 00:54:02
			$systemLogDatePattern = '(?:([0-9]+)\\s+)?([a-z]+)\\s+([0-9]+)\\s+([0-9]{2}):([0-9]{2}):([0-9]{2})';
			$systemLogDatePatternModifiers = 'im';
			
			$matches = XXX_String_Pattern::getMatches($timestampString, $systemLogDatePattern, $systemLogDatePatternModifiers);
			
			if (XXX_Array::getFirstLevelItemTotal($matches[0]) > 0)
			{
				$year = $matches[1][0];
				
				if ($year == '')
				{
					$year = XXX_TimestampHelpers::getCurrentYear();
				}
				
				$month = XXX_String::convertToLowerCase($matches[2][0]);
				
				switch ($month)
				{
					case 'jan':
						$month = 1;
						break;
					case 'feb':
						$month = 2;
						break;
					case 'mar':
						$month = 3;
						break;
					case 'apr':
						$month = 4;
						break;
					case 'may':
						$month = 5;
						break;
					case 'jun':
						$month = 6;
						break;
					case 'jul':
						$month = 7;
						break;
					case 'aug':
						$month = 8;
						break;
					case 'sep':
						$month = 9;
						break;
					case 'oct':
						$month = 10;
						break;
					case 'nov':
						$month = 11;
						break;
					case 'dec':
						$month = 12;
						break;
				}
				
				$date = XXX_Type::makeInteger($matches[3][0]);
				$hour = XXX_Type::makeInteger($matches[4][0]);
				$minute = XXX_Type::makeInteger($matches[5][0]);
				$second = XXX_Type::makeInteger($matches[6][0]);
				
				$timestamp = new XXX_Timestamp();
				$timestamp->compose(array('year' => $year, 'month' => $month, 'date' => $date, 'hour' => $hour, 'minute' => $minute, 'second' => $second));
				
				$result = $timestamp->get();
			}
			else
			{
				// 15/Oct/2012:14:08:00
				$accessCombinedLogDatePattern = '([0-9]+)/([a-z]+)/([0-9]+):([0-9]+):([0-9]+):([0-9]+)';
				$accessCombinedLogDatePatternModifiers = 'im';
				
				$matches = XXX_String_Pattern::getMatches($timestampString, $accessCombinedLogDatePattern, $accessCombinedLogDatePatternModifiers);
				
				if (XXX_Array::getFirstLevelItemTotal($matches[0]) > 0)
				{
					$year = $matches[3][0];
					
					if ($year == '')
					{
						$year = XXX_TimestampHelpers::getCurrentYear();
					}
					
					$month = XXX_String::convertToLowerCase($matches[2][0]);
					
					switch ($month)
					{
						case 'jan':
							$month = 1;
							break;
						case 'feb':
							$month = 2;
							break;
						case 'mar':
							$month = 3;
							break;
						case 'apr':
							$month = 4;
							break;
						case 'may':
							$month = 5;
							break;
						case 'jun':
							$month = 6;
							break;
						case 'jul':
							$month = 7;
							break;
						case 'aug':
							$month = 8;
							break;
						case 'sep':
							$month = 9;
							break;
						case 'oct':
							$month = 10;
							break;
						case 'nov':
							$month = 11;
							break;
						case 'dec':
							$month = 12;
							break;
					}
					
					$date = XXX_Type::makeInteger($matches[1][0]);
					$hour = XXX_Type::makeInteger($matches[4][0]);
					$minute = XXX_Type::makeInteger($matches[5][0]);
					$second = XXX_Type::makeInteger($matches[6][0]);
					
					$timestamp = new XXX_Timestamp();
					$timestamp->compose(array('year' => $year, 'month' => $month, 'date' => $date, 'hour' => $hour, 'minute' => $minute, 'second' => $second));
					
					$result = $timestamp->get();
				}
			}			
		}
		
		return $result;
	}
	
	
	public static function normalizeTimestampString ($timestampString)
	{
		$timestamp = self::convertTimestampStringToTimestamp($timestampString);
		
		$timestamp = new XXX_Timestamp($timestamp);
		
		$timestampParts = $timestamp->parse();
		
		$result = $timestampParts['iso8601'];
		
		return $result;
	}
	
	
	public static function getPeriodicInformation ()
	{
		$timestamp = new XXX_Timestamp();
		$timestampParts = $timestamp->parse(true);
		
		$hour = $timestampParts['hour'];
		$minute = $timestampParts['minute'];
		
		$frequency = array();
		
		$frequency['nthMinute'] = array
		(
			'1' => true,
			'5' => $minute % 5 == 0,
			'10' => $minute % 10 == 0,
			'15' => $minute % 15 == 0,
			'20' => $minute % 20 == 0,
			'30' => $minute % 30 == 0,
			'60' => $minute == 0,
			'1440' => $hour == 0 && $minute == 0
		);
		
		$frequency['nthSecond'] = array
		(
			'60' => $frequency['nthMinute']['1'],
			'300' => $frequency['nthMinute']['5'],
			'600' => $frequency['nthMinute']['10'],
			'900' => $frequency['nthMinute']['15'],
			'1200' => $frequency['nthMinute']['20'],
			'1800' => $frequency['nthMinute']['30'],
			'3600' => $frequency['nthMinute']['60'],
			'86400' => $frequency['nthMinute']['1440']
		);
		
		$frequency['ly'] = array
		(
			'minutely' => $frequency['nthMinute']['1'],
			'5Minutely' => $frequency['nthMinute']['5'],
			'10Minutely' => $frequency['nthMinute']['10'],
			'15Minutely' => $frequency['nthMinute']['15'],
			'quarterOfAnHourly' => $frequency['nthMinute']['15'],
			'20Minutely' => $frequency['nthMinute']['20'],
			'30Minutely' => $frequency['nthMinute']['30'],
			'halfAnHourly' => $frequency['nthMinute']['30'],
			'hourly' => $frequency['nthMinute']['60'],
			'2Hourly' => $frequency['nthMinute']['60'] && ($hour % 2 == 0),
			'3Hourly' => $frequency['nthMinute']['60'] && ($hour % 3 == 0),
			'6Hourly' => $frequency['nthMinute']['60'] && ($hour % 6 == 0),
			'12Hourly' => $frequency['nthMinute']['60'] && ($hour % 12 == 0),
			'daily' => $frequency['nthMinute']['1440'],
			'weekly' => $frequency['nthMinute']['1440'] && $timestampParts['dayOfTheWeek'] == 1,
			'monthly' => $frequency['nthMinute']['1440'] && $timestampParts['dayOfTheMonth'] == 1,
			'quarterly' => $frequency['nthMinute']['1440'] && $timestampParts['dayOfTheMonth'] == 1 && ($timestampParts['monthOfTheYear'] == 1 || $timestampParts['monthOfTheYear'] == 4 || $timestampParts['monthOfTheYear'] == 7 || $timestampParts['monthOfTheYear'] == 10),
			'yearly' => $frequency['nthMinute']['1440'] && $timestampParts['dayOfTheMonth'] == 1 && $timestampParts['monthOfTheYear'] == 1,
			'halfYearly' => $frequency['nthMinute']['1440'] && $timestampParts['dayOfTheMonth'] == 1 && $timestampParts['monthOfTheYear'] == 7
		);
		
		$frequency['nthDayOfTheWeek'] = array
		(
			'1' => $timestampParts['dayOfTheWeek'] == 1,
			'2' => $timestampParts['dayOfTheWeek'] == 2,
			'3' => $timestampParts['dayOfTheWeek'] == 3,
			'4' => $timestampParts['dayOfTheWeek'] == 4,
			'5' => $timestampParts['dayOfTheWeek'] == 5,
			'6' => $timestampParts['dayOfTheWeek'] == 6,
			'7' => $timestampParts['dayOfTheWeek'] == 7
		);
		
		$frequency['dayOfTheWeek'] = array
		(
			'monday' => $timestampParts['dayOfTheWeek'] == 1,
			'tuesday' => $timestampParts['dayOfTheWeek'] == 2,
			'wednesday' => $timestampParts['dayOfTheWeek'] == 3,
			'thursday' => $timestampParts['dayOfTheWeek'] == 4,
			'friday' => $timestampParts['dayOfTheWeek'] == 5,
			'saturday' => $timestampParts['dayOfTheWeek'] == 6,
			'sunday' => $timestampParts['dayOfTheWeek'] == 7
		);
		
		$frequency['other'] = array
		(
			'midnight' => $hour == 0 && $minute == 0,
			'noon' => $hour == 12 && $minute == 0,
			'evening' => $hour == 18 && $minute == 0,
			'morning' => $hour == 6 && $minute == 0
		);
		
		$result = array
		(
			'timestamp' => $timestampParts,
			'frequency' => $frequency
		);
		
		return $result;
	}	
	
	
	
	
	
	public static function composeTimeValue ($timestamp, $clockType)
	{
		$clockType = XXX_Default::toOption($clockType, array('12', '24'), '24');
		
		$timeValue = '';
		
		if (XXX_Type::isInteger($timestamp))
		{
			$timestamp = new XXX_Timestamp($timestamp);
		}
		
		$timestampParts = $timestamp->parse();
		
		$hour = $timestampParts['hour'];
		$minute = $timestampParts['minute'];
		$meridiem = '';
		
		if ($clockType == '12')
		{
			if ($hour < 12)
			{
				$meridiem = 'am';
				
				if ($hour == 0)
				{
					$hour = 12;
				}
			}
			else
			{				
				$meridiem = 'pm';
				
				$hour -= 12;
				
				if ($hour == 0)
				{
					$hour = 12;
				}
			}
		}
				
		$composedHour = XXX_String::padLeft($hour, '0', 2);
		
		$composedMinute = XXX_String::padLeft($minute, '0', 2);
				
		$composedMeridiem = '';
		
		$meridiemNames = XXX_I18n_Translation::get('dateTime', 'meridiems', 'abbreviations');
		
		if ($meridiem == 'am')
		{
			$composedMeridiem = $meridiemNames[0];
		}
		else
		{
			$composedMeridiem = $meridiemNames[1];
		}
		
		switch ($clockType)
		{
			case '12':
				$timeValue = $composedHour . ':' . $composedMinute . ' ' . $composedMeridiem;
				break;
			case '24':
				$timeValue = $composedHour . ':' . $composedMinute;
				break;
		}
		
		return $timeValue;
	}
	
	public static function composeDateValue ($timestamp = 0, $dateFormat = 'dateMonthYear')
	{
		$dateFormat = XXX_Default::toOption($dateFormat, array('dateMonthYear', 'monthDateYear', 'yearMonthDate'), 'dateMonthYear');
		
		$separator = ' ';
		
		$dateValue = '';
		
		if (XXX_Type::isInteger($timestamp))
		{
			$timestamp = new XXX_Timestamp($timestamp);
		}
		
		$timestampParts = $timestamp->parse();
		
		$composedYear = XXX_String::padLeft($timestampParts['year'], '0', 4);
		$composedMonth = XXX_String::padLeft($timestampParts['month'], '0', 2);
		$composedDate = XXX_String::padLeft($timestampParts['date'], '0', 2);
		
		$composedMonthName = '';
		
		$monthNames = array
		(
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'january'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'february'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'march'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'april'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'may'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'june'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'july'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'august'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'september'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'october'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'november'),
			XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'december')
		);
		
		$composedMonthName = $monthNames[$timestampParts['month'] - 1];
		
		$composedDayOfTheWeekName = '';
		$dayOfTheWeekNames = array
		(
			XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'monday'),
			XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'tuesday'),
			XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'wednesday'),
			XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'thursday'),
			XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'friday'),
			XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'saturday'),
			XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'sunday')
		);
		
		$composedDayOfTheWeekName = $dayOfTheWeekNames[$timestampParts['dayOfTheWeek'] - 1];
		
		switch ($dateFormat)
		{
			case 'dateMonthYear':
				$dateValue = $composedDayOfTheWeekName . ' ' . $composedDate . $separator . $composedMonthName . $separator . $composedYear;
				break;
			case 'monthDateYear':
				$dateValue = $composedMonthName . $separator . $composedDayOfTheWeekName . ' ' . $composedDate . $separator . $composedYear;
				break;
			case 'yearMonthDate':
				$dateValue = $composedYear . $separator . $composedMonthName . $separator . $composedDayOfTheWeekName . ' ' . $composedDate;
				break;
		}
		
		return $dateValue;
	}
	
	
	
	
	
	
	
	
	public static function parseTimeValue ($timeValue = '', $clockType = '24')
	{
		$clockType = XXX_Default::toOption($clockType, array('12', '24'), '24');
		
		$original = $timeValue;
		
		$clockType = XXX_Default::toOption($clockType, array('12', '24'), '24');
		
		$hour = 12;
		$minute = 0;
		$meridiem = 'pm';
		
		$newHour = hour;
		$newMinute = minute;
		$newMeridiem = false;
		
		if ($timeValue != '')
		{
			$timeValue = XXX_String::convertToLowerCase($timeValue);
			
			$matches = XXX_String_Pattern::getMatches($timeValue, '([0-9]{1,2})(?:[/\\-. :,\'"]*([0-9]{1,2}))?[/\\-. :,\'"]*([apm. ]{2,})?', 'i');
			
			if (XXX_Array::getFirstLevelItemTotal($matches) == 2)
			{
				$newHour = XXX_Type::makeInteger($matches[1][0]);
			}
			else if (XXX_Array::getFirstLevelItemTotal($matches) == 3)
			{
				$newHour = XXX_Type::makeInteger($matches[1][0]);
				$newMinute = XXX_Type::makeInteger($matches[2][0]);
			}
			else if (XXX_Array::getFirstLevelItemTotal($matches) == 4)
			{
				$newHour = XXX_Type::makeInteger($matches[1][0]);
				$newMinute = XXX_Type::makeInteger($matches[2][0]);
				
				$temp = XXX_String::trim($matches[3][0]);
				
				if (XXX_String::findFirstPosition($temp, 'a') > -1)
				{
					$newMeridiem = 'am';
				}
				else if (XXX_String::findFirstPosition($temp, 'p') > -1)
				{
					$newMeridiem = 'pm';
				}
			}
			
			$newHour = XXX_Number::absolute($newHour);
			$newMinute = XXX_Number::absolute($newMinute);
			$newMinute %= 60;
			
			switch ($clockType)
			{
				case '12':
					
					$newHour %= 24;
					
					if ($newMeridiem == false)
					{
						if ($newHour == 12)
						{
							$newHour = 0;
						}
					}
					else if ($newMeridiem == 'pm')
					{
						if ($newHour < 12)
						{
							$newHour += 12;
						}
					}
					
					break;
				case '24':
					$newHour %= 24;					
					break;
			}
					
			if (!($newHour >= 0 && $newHour < 24 && $newMinute >= 0 && $newMinute < 60))
			{
				$newHour = $hour;
				$newMinute = $minute;
			}
					
			if ($newHour < 12)
			{
				$newMeridiem = 'am';
			}
			else
			{
				$newMeridiem = 'pm';
			}
		}
		
		$result = array
		(
			'original' => $original,
			'hour' => $newHour,
			'minute' => $newMinute,
			'meridiem' => $newMeridiem
		);
		
		return $result;
	}	
	
	
	
	
	public static function parseDateValue ($dateValue, $dateFormat)
	{
		$original = $dateValue;
		
		XXX_PHP::errorNotification(0, 'Parsing date value ' . $dateValue);
		
		$dateFormat = XXX_Default::toOption($dateFormat, array('dateMonthYear', 'monthDateYear', 'yearMonthDate'), 'dateMonthYear');
		
		$todaysDate = new XXX_Timestamp();
		$todaysDateParts = $todaysDate->parse();
				
		$year = $todaysDateParts['year'];
		$month = $todaysDateParts['month'];
		$date = $todaysDateParts['date'];
		
		$newYear = $year;
		$newMonth = $month;
		$newDate = $date;
		
		if ($dateValue != '')
		{
			$dateValue = XXX_String::convertToLowerCase($dateValue);
			
			$parts = XXX_String_Pattern::splitToArray($dateValue, '[/\\-., :\'"]+', '');
			
				//XXX_PHP::errorNotification(0, 'Parsed date parts ' . XXX_String_JSON::encode($parts));
				
			$filteredParts = array();
			
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($parts); $i < $iEnd; ++$i)
			{
				$filteredPart = XXX_String::trim($parts[$i]);
				
				$monthNames = array
				(
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'january'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'february'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'march'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'april'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'may'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'june'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'july'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'august'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'september'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'october'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'november'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'names', 'december')
				);
				
				$monthAbbreviations = array
				(
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'january'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'february'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'march'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'april'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'may'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'june'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'july'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'august'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'september'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'october'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'november'),
					XXX_I18n_Translation::get('custom', 'calendar', 'months', 'abbreviations', 'december')
				);
							
				$isMonth = false;
				
				for ($j = 0, $jEnd = XXX_Array::getFirstLevelItemTotal($monthNames); $j < $jEnd; ++$j)
				{
					if (XXX_String::convertToLowerCase($monthNames[$j]) == XXX_String::convertToLowerCase($filteredPart))
					{
						$filteredPart = $j + 1;
						
						$isMonth = true;
						
						break;
					}
				}
				
				if (!$isMonth)
				{
					for ($j = 0, $jEnd = XXX_Array::getFirstLevelItemTotal($monthAbbreviations); $j < $jEnd; ++$j)
					{
						if (XXX_String::convertToLowerCase($monthAbbreviations[$j]) == XXX_String::convertToLowerCase($filteredPart))
						{
							$filteredPart = $j + 1;
						
							$isMonth = true;
							
							break;
						}
					}
				}
				
				
				$isDayOfTheWeek = false;
			
				$dayOfTheWeekNames = array
				(
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'names', 'monday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'names', 'tuesday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'names', 'wednesday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'names', 'thursday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'names', 'friday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'names', 'saturday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'names', 'sunday')
				);
				
				
				$dayOfTheWeekAbbreviations = array
				(
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'monday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'tuesday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'wednesday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'thursday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'friday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'saturday'),
					XXX_I18n_Translation::get('custom', 'calendar', 'daysOfTheWeek', 'abbreviations', 'sunday')
				);
				
				for ($j = 0, $jEnd = XXX_Array::getFirstLevelItemTotal($dayOfTheWeekNames); $j < $jEnd; ++$j)
				{
					if (XXX_String::convertToLowerCase($dayOfTheWeekNames[$j]) == XXX_String::convertToLowerCase($filteredPart))
					{
						$isDayOfTheWeek = true;
						
						break;
					}
				}
				
				if (!$isDayOfTheWeek)
				{
					for ($j = 0, $jEnd = XXX_Array::getFirstLevelItemTotal($dayOfTheWeekAbbreviations); $j < $jEnd; ++$j)
					{
						if (XXX_String::convertToLowerCase($dayOfTheWeekAbbreviations[$j]) == XXX_String::convertToLowerCase($filteredPart))
						{
							$isDayOfTheWeek = true;
							
							break;
						}
					}
				}
				
				if (!$isDayOfTheWeek)
				{
						
					$filteredParts[] = $filteredPart;
				}
			}
			
			//XXX_Type::peakAtVariable($filteredParts);
			
			$parts = $filteredParts;
			
			if (XXX_Array::getFirstLevelItemTotal($parts) == 0)
			{			
			}
			else if (XXX_Array::getFirstLevelItemTotal($parts) == 1)
			{
				switch ($dateFormat)
				{
					case 'dateMonthYear':
						$newDate = XXX_Type::makeInteger($parts[0]);
						break;
					case 'monthDateYear':
						$newMonth = XXX_Type::makeInteger($parts[0]);
						break;
					case 'yearMonthDate':
						$newYear = XXX_Type::makeInteger($parts[0]);
						break;
				}
			}
			else if (XXX_Array::getFirstLevelItemTotal($parts) == 2)
			{
				switch ($dateFormat)
				{
					case 'dateMonthYear':
						$newDate = XXX_Type::makeInteger($parts[0]);
						if ($parts[1] != '')
						{
							$newMonth = XXX_Type::makeInteger($parts[1]);
						}
						break;
					case 'monthDateYear':
						$newMonth = XXX_Type::makeInteger($parts[0]);
						if ($parts[1] != '')
						{
							$newDate = XXX_Type::makeInteger($parts[1]);
						}
						break;
					case 'yearMonthDate':
						$newYear = XXX_Type::makeInteger($parts[0]);
						if ($parts[1] != '')
						{
							$newMonth = XXX_Type::makeInteger($parts[1]);
						}
						break;
				}
			}
			else if (XXX_Array::getFirstLevelItemTotal($parts) >= 3)
			{
				switch ($dateFormat)
				{
					case 'dateMonthYear':
						$newDate = XXX_Type::makeInteger($parts[0]);
						$newMonth = XXX_Type::makeInteger($parts[1]);
						if ($parts[2] != '')
						{
							$newYear = XXX_Type::makeInteger($parts[2]);
						}
						break;
					case 'monthDateYear':
						$newMonth = XXX_Type::makeInteger($parts[0]);
						$newDate = XXX_Type::makeInteger($parts[1]);
						if ($parts[2] != '')
						{
							$newYear = XXX_Type::makeInteger($parts[2]);
						}
						break;
					case 'yearMonthDate':
						$newYear = XXX_Type::makeInteger($parts[0]);
						$newMonth = XXX_Type::makeInteger($parts[1]);
						if ($parts[2] != '')
						{
							$newDate = XXX_Type::makeInteger($parts[2]);
						}
						break;
				}
			}
			
			$newMonth = XXX_Number::absolute($newMonth);			
			$newMonth %= 12;
			if ($newMonth == 0)
			{
				$newMonth = 12;
			}
			
			$newDate = XXX_Number::absolute($newDate);
			$newDate %= 31;
			if ($newDate == 0)
			{
				$newDate = 31;
			}
			
			if ($newYear >= 0 && $newYear <= 100)
			{
				$currentYear = XXX_TimestampHelpers::getCurrentYear();
				$tempFutureYear = 2000 + $newYear;
				$tempPastYear = 1900 + $newYear;
				
				if ($tempFutureYear <= $currentYear + 10)
				{
					$newYear = $tempFutureYear;
				}
				else
				{
					$newYear = $tempPastYear;
				}
			}
			
			if (!XXX_TimestampHelpers::isExistingDate($newYear, $newMonth, $newDate))
			{
				//XXX_PHP::errorNotification(0, 'Defaulting back ' . $newYear . '-' . $newMonth . '-' . $newDate . ' to now');
				
				$newDate = $date;
				$newMonth = $month;
				$newYear = $year;
			}
			
			//XXX_PHP::errorNotification(0, 'Defaulting back ' . $newYear . '-' . $newMonth . '-' . $newDate . ' to now');
		}
				
		$result = array
		(
			'original' => $original,
			'date' => $newDate,
			'month' => $newMonth,
			'year' => $newYear
		);
		
		return $result;
	}
	
	public static function convertUTCTimestampToLocalTimestampForTimezoneCity ($utcTimestamp = 0, $timezoneCity = 'UTC')
	{
		return self::getLocalTimestampForUTCTimestampForTimezoneCity($utcTimestamp, $timezoneCity);
	}
	
	public static function convertLocalTimestampToUTCTimestampForTimezoneCity ($localTimestamp = 0, $timezoneCity = 'UTC')
	{
		if (XXX_String::trim($timezoneCity) == '')
		{
			$timezoneCity = 'UTC';
		}
		$tempTimestamp = new XXX_Timestamp($localTimestamp);
		$tempTimestampParts = $tempTimestamp->parse();
				
		$tempDateTime = new DateTime();
		$tempDateTime->setTimezone(new DateTimeZone($timezoneCity));
		$tempDateTime->setDate($tempTimestampParts['year'], $tempTimestampParts['month'], $tempTimestampParts['date']);
		$tempDateTime->setTime($tempTimestampParts['hour'], $tempTimestampParts['minute'], $tempTimestampParts['second']);
		
		$localOffset = $tempDateTime->getOffset();
		
		$utcTimestamp = $localTimestamp - $localOffset;
		
		return $utcTimestamp;
	}
	
	public static function getLocalTimestampForUTCTimestampForTimezoneCity ($utcTimestamp = 0, $timezoneCity = 'UTC')
	{
		if (XXX_String::trim($timezoneCity) == '')
		{
			$timezoneCity = 'UTC';
		}
				
		$tempDateTime = new DateTime('@' . $utcTimestamp);
		$tempDateTime->setTimezone(new DateTimeZone('UTC'));
		
		$tempDateTime->setTimezone(new DateTimeZone($timezoneCity));
		
		$localOffset = $tempDateTime->getOffset();
		
		$localTimestamp = $utcTimestamp + $localOffset;
		
		return $localTimestamp;
	}
	
	public static function getUTCTimestampForLocalTimestampForTimezoneCity ($localTimestamp = 0, $timezoneCity = 'UTC')
	{
		if (XXX_String::trim($timezoneCity) == '')
		{
			$timezoneCity = 'UTC';
		}
		$tempDateTime = new DateTime();
		$tempDateTime->setTimezone(new DateTimeZone($timezoneCity));
		
		$tempDateTime->setTimestamp($localTimestamp);
		
		$localOffset = $tempDateTime->getOffset();
				
		$utcTimestamp = $localTimestamp - $localOffset;
		
		return $utcTimestamp;
	}
	
	public static function getOffsetForLocalTimestampForTimezoneCity ($localTimestamp = 0, $timezoneCity = 'UTC')
	{
		if (XXX_String::trim($timezoneCity) == '')
		{
			$timezoneCity = 'UTC';
		}
		$tempDateTime = new DateTime();
		$tempDateTime->setTimezone(new DateTimeZone($timezoneCity));
		
		$tempDateTime->setTimestamp($localTimestamp);
		
		$localOffset = $tempDateTime->getOffset();
		
		return $localOffset;
	}
	
	public static function getTimezoneAbbreviationForTimezoneCity ($timezoneCity = 'UTC')
	{
		$result = false;
		
		if($timezoneCity)
		{
			$timezoneAbbreviationList = timezone_abbreviations_list();
			
			$abb_array = array();
			foreach ($timezoneAbbreviationList as $abb_key => $abb_val)
			{
				foreach ($abb_val as $key => $value)
				{
					$value['abb'] = $abb_key;
					array_push($abb_array, $value);
				}
			}
			
			foreach ($abb_array as $key => $value)
			{
				if ($value['timezone_id'] == $timezoneCity)
				{
					$result = strtoupper($value['abb']);
					
					break;
				}
			}
		}
		return $result;
	}
}

?>
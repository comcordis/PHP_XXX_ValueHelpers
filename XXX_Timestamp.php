<?php


// TODO Check Shorthand year, since 1900, so 2023 = 23 or 123?

// UTC (Global) based - No timezones, DST etc.
class XXX_Timestamp
{
	protected $timestamp = 0;
	
	public function __construct ($tempParameter = false)
	{
		$this->timestamp = time();
		
		if (XXX_Type::isArray($tempParameter))
		{
			$this->compose($tempParameter);
		}
		else if (XXX_Type::isInteger($tempParameter))
		{
			$this->set($tempParameter);
		}
	}
		
	// Seconds
	public function set ($timestamp)
	{
		if (XXX_Type::isPositiveInteger($timestamp))
		{
			$this->timestamp = $timestamp;
		}
	}
	
	// Seconds
	public function get ()
	{
		return $this->timestamp;
	}
	
	public function makeLocal ()
	{
		$this->timestamp += XXX_TimestampHelpers::getLocalSecondOffset();
	}	
	
	// Reversed of makeLocal
	public function makeGlobal ()
	{
		$this->timestamp -= XXX_TimestampHelpers::getLocalSecondOffset();
	}
	
	public function parse ($extended = false)
	{
		$year = date('Y', $this->timestamp);
		$yearShort = XXX_String::getPart($year, -2, 2);
		
		$dayOfTheWeek = date('w', $this->timestamp);
		
		// Convert Sunday to last day of the week
		if ($dayOfTheWeek == 0)
		{
			$dayOfTheWeek = 7;
		}
		
		$dayOfTheMonth = date('j', $this->timestamp);
		
		$monthOfTheYear = date('n', $this->timestamp);
		
		$hour = date('G', $this->timestamp);
		$minute = XXX_Type::makeInteger(date('i', $this->timestamp));
		$second = XXX_Type::makeInteger(date('s', $this->timestamp));
		
		$meridiem = 'am';
		
		if ($hour >= 12)
		{
			$meridiem = 'pm';
		}
		
		$hourShort = $hour;
		
		if ($hourShort > 12)
		{
			$hourShort -= 12;
		}
		
		if ($hourShort == 0)
		{
			$hourShort = 12;
		}
		
		// http://en.wikipedia.org/wiki/ISO_8601
		$iso8601 = date('Y-m-d\TH:i:s\Z', $this->timestamp);
		
		$parts = array
		(
			'timestamp' => $this->timestamp,
			'year' => $year,
			'yearShort' => $yearShort,
			'month' => $monthOfTheYear,
			'monthOfTheYear' => $monthOfTheYear,
			'date' => $dayOfTheMonth,
			'dayOfTheMonth' => $dayOfTheMonth,
			'dayOfTheWeek' => $dayOfTheWeek,
			'hour' => $hour,
			'hourShort' => $hourShort,
			'minute' => $minute,
			'second' => $second,
			'meridiem' => $meridiem,
			'iso8601' => $iso8601,
			'string' => $iso8601
		);
		
		if ($extended)
		{
			$parts['dayTotalInMonth'] = XXX_TimestampHelpers::getDayTotalInMonth($year, $monthOfTheYear);
			$parts['dayTotalInYear'] = XXX_TimestampHelpers::getDayTotalInYear($year);
			$parts['dayOfTheYear'] = XXX_TimestampHelpers::getDayOfTheYear($year, $monthOfTheYear, $dayOfTheMonth);
			$parts['leapYear'] = XXX_TimestampHelpers::isLeapYear($year);
			$parts['weekOfTheYear'] = XXX_Timestamphelpers::iso8601_getWeekOfTheYear($year, $monthOfTheYear, $dayOfTheMonth);
		}
		
		return $parts;
	}
	
	public function compose ($parts = array())
	{
		// Year
		if (!XXX_Type::isInteger($parts['year']))
		{
			$parts['year'] = date('Y');
		}
		
		// Month
		if (!XXX_Type::isInteger($parts['month']) && ($parts['month'] >= 1 && $parts['month'] <= 12))
		{
			$parts['month'] = date('n');
		}
		
		// Date
		if (!XXX_Type::isInteger($parts['date']) && ($parts['date'] >= 1 && $parts['date'] <= 31))
		{
			$parts['date'] = date('j');
		}
		
		if (!XXX_TimestampHelpers::isExistingDate($parts['year'], $parts['month'], $parts['date']))
		{
			$dayTotalInMonth = XXX_TimestampHelpers::getDayTotalInMonth($parts['year'], $parts['month']);
			
			$parts['date'] = $dayTotalInMonth;
		}
		
		// Hour
		if (!XXX_Type::isInteger($parts['hour']) && ($parts['hour'] >= 0 && $parts['hour'] <= 23))
		{
			$parts['hour'] = date('G');
		}
		
		// Minute
		if (!XXX_Type::isInteger($parts['minute']) && ($parts['minute'] >= 0 && $parts['minute'] <= 59))
		{
			$parts['minute'] = XXX_Type::makeInteger(date('i'));
		}
		
		// Second
		if (!XXX_Type::isInteger($parts['second']) && ($parts['second'] >= 0 && $parts['second'] <= 59))
		{
			$parts['second'] = XXX_Type::makeInteger(date('s'));
		}
		
		$this->timestamp = mktime($parts['hour'], $parts['minute'], $parts['second'], $parts['month'], $parts['date'], $parts['year']);
	}
}

?>
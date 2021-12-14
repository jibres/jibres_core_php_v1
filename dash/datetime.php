<?php
namespace dash;

class datetime
{
	/**
	 * Gets the current time zone.
	 *
	 * @return     string  The current time zone.
	 */
	public static function get_current_timezone()
	{
		return 'America/New_York';
		return 'Asia/Hong_Kong';
		return 'Asia/Tehran';
	}



	/**
	 * Sets the default timezone.
	 */
	public static function set_default_timezone()
	{
		if(self::get_current_timezone() !== date_default_timezone_get())
		{
			// date_default_timezone_set(self::get_current_timezone());
		}
	}


	/**
	 * Date by convert timezone
	 *
	 * @param      <type>  $_format  The format
	 * @param      <type>  $_time    The time
	 *
	 * @return     \       ( description_of_the_return_value )
	 */
	public static function my_date($_format, $_time = null)
	{
		if(!$_time)
		{
			$_time = time();
		}

		// Create the datetime and set the timestamp
		$date_time = new \DateTime();
		$date_time->setTimestamp($_time);

		// Convert to timezone
		$date_time_zone = new \DateTimeZone(self::get_current_timezone());
		$date_time->setTimeZone($date_time_zone);

		$my_date = $date_time->format($_format);

		return $my_date;
	}


	/**
	 * return all format supported
	 * @param  [type]  $_type [description]
	 * @param  boolean $_format [description]
	 * @return [type]         [description]
	 */
	public static function format($_model = null, $_type = null, $_lang = null)
	{
		switch ($_type)
		{
			case 'date':
			if($_model === true)
			{
				// Tuesday 25 September 2018
				return 'l j F Y';
			}
			elseif($_model === 'readable')
			{
				if(\dash\language::current() === 'fa')
				{
					// 23 Jun 2021
					return 'j F Y';
				}

				// Jun 23, 2021
				return 'F j, Y';
			}
			elseif($_model)
			{
				return $_model;
			}
			// 2018-09-25
			return 'Y-m-d';

				break;

			case 'time':
				switch ($_model)
				{
					case true:
						// 16:05:52
						return 'H:i:s';
						// 4:05:52 PM
						// return 'g:i:s A';
						break;

					case false:
					default:
						// 16:05
						return 'H:i';
						break;
				}
				break;

			case 'datetime':
			default:
				if($_model === 'shortTime')
				{
					return 'l j F Y'. ' '. 'H:i';
				}
				elseif($_model === 'shortDate')
				{
					return 'Y-m-d'. ' '. 'H:i:s';
				}
				elseif ($_model === true)
				{
					return 'l j F Y'. ' '. 'H:i:s';
				}
				elseif ($_model === false || $_model === null)
				{
					return 'Y-m-d'. ' '. 'H:i';
				}
				else
				{
					return $_model;
				}
		}
	}


	public static function get($_datetime = null, $_format = null, $_type = 'datetime', $_lang = null, $_convertNumber = null)
	{
		// step1 - check datetime
		if($_datetime === null)
		{
			$_datetime = date("Y-m-d H:i:s");
		}
		if(!$_datetime)
		{
			return null;
		}

		// step2 - get new format
		$myFormat   = self::format($_format, $_type);
		$myDatetime = strtotime($_datetime);
		$finalDate  = null;
		// detect current lang if not set
		if($_lang === null)
		{
			$_lang = \dash\language::current();
		}
		// check if we have date in format but value of date is zero, try to remove it
		if(date('H:i:s', $myDatetime) === '00:00:00' && \dash\str::strpos($myFormat, 'H:i:s') > 0)
		{
			$myFormat = str_replace(' H:i:s', '', $myFormat);
		}

		// step3 - change to new format
		switch ($_lang)
		{
			case 'fa':
				$finalDate = \dash\utility\jdate::date($myFormat, $myDatetime);
				break;

			case 'en':
			default:
				$finalDate = self::my_date($myFormat, $myDatetime);
				break;
		}

		// step4 - change number to fa if need
		if($_convertNumber !== false)
		{
			$finalDate = \dash\fit::text($finalDate);
		}


		return $finalDate;
	}


	public static function fit($_datetime = null, $_format = null, $_type = null, $_calendar = null)
	{
		if($_datetime === null || $_datetime === true)
		{
			$_datetime = date("Y-m-d H:i:s");
		}
		if(!$_datetime)
		{
			return null;
		}

		// change all number to en number
		$_datetime = \dash\utility\convert::to_en_number($_datetime);
		// check number is not zero
		$checkDate = preg_replace('/\D/', '', $_datetime);
		$checkDate = intval($checkDate);
		if($_datetime !== "now" && $checkDate === 0)
		{
			return null;
		}

		// check if strtotime is valid, on linux say invalid
		// on windows because of shamsi problem on strtotime check length
        $isValidDate = strtotime($_datetime);
        if($isValidDate === false)
        {
            if(PHP_OS == 'Linux')
        	{
        		return null;
        	}
        	else
        	{
        		// it's for me on windows
        		// i am Javad!
                if(strlen(intval($_datetime)) > 7)
                {
                    // do nothing
                    // maybe it's correct!
                }
                else
                {
                    return null;
                }
        	}
        }

        if($_format === 'humanTime')
        {
			return \dash\utility\human::time($_datetime, $_type);
        }
        elseif($_format === 'human')
        {
			return \dash\utility\human::timing($_datetime, $_type);
        }
        else
        {
			return self::get($_datetime, $_format, $_type, $_calendar);
        }

	}


	/**
	 * Weekday list
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function weekday_list()
	{
		$list = ['monday','tuesday','wednesday','thursday','friday', 'saturday','sunday',];

		if(\dash\language::current() === 'fa')
		{
			$list = ['saturday','sunday', 'monday','tuesday','wednesday','thursday','friday',];
		}

		return $list;
	}

}
?>
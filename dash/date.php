<?php
namespace dash;

class date
{
	private static $lang = null;


	public static function birthday($_birthday, $_notif = false)
	{
		if(!$_birthday)
		{
			return null;
		}

		$birthday = self::db($_birthday);

		if($birthday === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid birthday"), 'birthday');
			}
			return false;
		}


		if(\dash\utility\jdate::is_jalali($birthday))
		{
			$birthday = \dash\utility\jdate::to_gregorian($birthday);
		}

		if($birthday === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid birthday"), 'birthday');
			}
			return false;
		}

		try
		{

			$datetime1 = new \DateTime($birthday);
			$datetime2 = new \DateTime(date("Y-m-d"));

			if($datetime1 >= $datetime2)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Invalid birthday, birthday can not larger than date now!"), 'birthday');
				}
				return false;
			}
		}
		catch(\Exception $e)
		{
			return false;
		}

		return $birthday;
	}


	/**
     * get month precent
     *
     *
     * @param      <type>  $_type  The type
     */
    public static function month_precent($_type = null)
    {
    	$lang = \dash\language::current();

    	if($lang === 'fa')
    	{
			$d = intval(\dash\utility\jdate::date("d", false, false));
			$m = intval(\dash\utility\jdate::date("m", false, false));
			$t = intval(\dash\utility\jdate::date("t", false, false));
    	}
    	else
    	{
			$d = intval(date("d"));
			$m = intval(date("m"));
			$t = intval(date("t"));
    	}

        $left   = round(($d * 100) / $t);
        $remain = round((($t - $d) * 100) / $t);

        $return = null;
        switch ($_type)
        {
            case 'left':
                $return = $left;
                break;
            case 'remain':
                $return = $remain;
                break;
            default:
                $return =
                [
					'left'   => $left,
					'remain' => $remain,
					'count'  => $t,
                ];
                break;
        }
        return $return;
    }


    /**
     * check language and if needed convert to persian date
     * else show default date
     * @param  [type] $_date [description]
     * @return [type]        [description]
     */
    public static function fit_lang($_format, $_stamp = false, $_type = false, $_persianChar = true)
    {
    	$result = null;

    	if(mb_strlen($_stamp) < 2)
    	{
    		$_stamp = false;
    	}

        // get target language
    	if($_type === 'default')
    	{
    		$_type = \dash\language::primary();
    	}
    	elseif($_type === 'current')
    	{
    		$_type = \dash\language::current();
    	}

        // if need persian use it else use default date function
    	if($_type === true || $_type === 'fa' || $_type === 'fa_IR')
    	{
    		$result = \dash\utility\jdate::date($_format, $_stamp, $_persianChar);
    	}
    	else
    	{
    		if($_stamp)
    		{
    			$result = date($_format, $_stamp);
    		}
    		else
    		{
    			$result = date($_format);
    		}
    	}

    	return $result;
    }


	private static function formatFinder($_type, $_format = 'short')
	{
		$format     = "Y-m-d H:i:s";

		if($_type === 'time')
		{
			switch ($_format)
			{
				case 'long':
					$format = "H:i:s";
					break;

				case 'short':
				default:
					$format = "H:i";
					break;
			}
		}
		else
		{
			switch ($_format)
			{
				case 'long':
					$format = "Y-m-d";
					break;

				case 'year':
					$format = "Y";
					break;

				case 'full':
					$format = "Y-m-d H:i:s";
					break;

				case 'short':
				default:
					$format = "Y/m/d";
					break;
			}
		}
		return $format;
	}


	private static function lang()
	{
		if(!self::$lang)
		{
			self::$lang = \dash\language::current();
		}

		return self::$lang;
	}


	public static function tdate($_timestamp = false, $_format = 'short', $_persianChar = false)
	{
		if($_timestamp === false)
		{
			$_timestamp = time();
		}

		$_timestamp = intval($_timestamp);

		$lang = self::lang();

		if($lang === 'fa')
		{
			$result = \dash\utility\jdate::date(self::formatFinder('date', $_format),$_timestamp, $_persianChar);
		}
		else
		{
			$result = date(self::formatFinder('date', $_format), $_timestamp);
		}

		return $result;
	}


	public static function ttime($_timestamp = false, $_format = 'short')
	{
		if($_timestamp === false)
		{
			$_timestamp = time();
		}
		$_timestamp = intval($_timestamp);

		$lang = self::lang();

		if($lang === 'fa')
		{
			$result = \dash\utility\jdate::date(self::formatFinder('time', $_format),$_timestamp, false);
		}
		else
		{
			$result = date(self::formatFinder('time', $_format), $_timestamp);
		}

		return $result;

	}


	public static function force_gregorian($_date)
	{
		if(\dash\utility\jdate::is_jalali($_date))
		{
			$_date = \dash\utility\jdate::to_gregorian($_date);
		}

		return $_date;

	}


	public static function force_jalali($_date)
	{
		if(\dash\utility\jdate::is_gregorian($_date))
		{
			$_date = \dash\utility\jdate::date("Y-m-d", strtotime($_date));
		}

		return $_date;
	}



	public static function db($_date, $_seperator = '-')
	{
		$myDate = trim($_date);
		if(!$myDate)
		{
			return null;
		}
		$myDate    = \dash\utility\convert::to_en_number($myDate);
		$myDate    = str_replace('/', '-', $myDate);
		$myDateLen = strlen($myDate);

		if($myDateLen === 10)
		{
			// do nothing
		}
		elseif($myDateLen === 8 && is_numeric($myDateLen) && strpos($myDateLen, '-') === false)
		{
			// try to fix more on date as yyyy-mm-dd soon
			$convertedDate = strtotime($myDate);
			if ($convertedDate === false)
			{
				return false;
			}
			$myDate = date('Y-m-d', $convertedDate);
		}
		else
		{
			return false;
		}

		if($_seperator !== '-')
		{
			try
			{
				$convertedDate = \DateTime::createFromFormat("Y-m-d", $myDate);
				$myDate = $convertedDate->format('Y'. $_seperator. 'm'. $_seperator. 'd');
			}
			catch(\Exception $e)
			{
				return false;
			}

		}

		// retult always have 10 chars with format yyyy-mm-dd
		return $myDate;
	}


	public static function format($_date, $_format = 'Y-m-d', $_formatInput = 'Y-m-d')
	{
		$myDate = self::db($_date);

		$convertedDate = strtotime($myDate);
		if ($convertedDate === false)
		{
			try
			{
				$convertedDate = \DateTime::createFromFormat($_formatInput, $myDate);
			}
			catch(\Exception $e)
			{
				return false;
			}

			if($convertedDate)
			{
				$convertedDate = $convertedDate->format($_format);
			}
		}
		else
		{
			$convertedDate = date($_format, $convertedDate);
		}

		return $convertedDate;
	}


}
?>

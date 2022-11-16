<?php
namespace dash\validate;

class datetime
{


	public static function date($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		if(!is_string($data) && !is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be string or number", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(mb_strlen($data) < 2)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be larger than 2 character", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		if(mb_strlen($data) > 30)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be less than 30 character", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$data = \dash\utility\convert::to_en_number($data);

		$convertedDate = strtotime($data);
		if($convertedDate === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val is not a valid date field", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$format = 'Y-m-d';

		if(isset($_meta['format']))
		{
			$format = $_meta['format'];
		}

		if(\dash\utility\jdate::is_jalali($data))
		{
			$time = null;

			if(\dash\str::strpos($format, 'H') !== false)
			{
				$time = date("H:i:s", strtotime($data));
			}


			$data = \dash\utility\jdate::to_gregorian($data);

			if(!$data)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val is not a valid date field", ['val' => $_field_title]), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}

			if($time)
			{
				$data = $data . ' ' . $time;
			}

		}


		$data = date($format, strtotime($data));

		try
		{

			$data_datetime = new \DateTime($data);
			$year          = $data_datetime->format("Y");


			if(isset($_meta['is_timestamp']) && $_meta['is_timestamp'])
			{
				$minYear = 1971;
				$maxYear = 2035;
			}
			elseif(isset($_meta['is_birthdate']) && $_meta['is_birthdate'])
			{
				$currentYear = date("Y");
				$minYear     = intval($currentYear) - 150;
				$maxYear     = intval($currentYear);
			}
			else
			{
				$minYear = 1000;
				$maxYear = 9999;
			}

			/**
			 * MySQL retrieves and displays DATETIME values in ' YYYY-MM-DD hh:mm:ss ' format. The supported range is '1000-01-01 00:00:00' to '9999-12-31 23:59:59' .
			 * The TIMESTAMP data type is used for values that contain both date and time parts. TIMESTAMP has a range of '1970-01-01 00:00:01' UTC to '2038-01-19 03:14:07' UTC.
			 */
			if(intval($year) > $maxYear)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Invalid date"), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}

			if(intval($year) < $minYear)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Invalid date"), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}


			$date = $data_datetime->format($format);


		}
		catch (\Exception $e)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid date"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		return $data;
	}


	public static function birthdate($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$_meta['is_birthdate'] = true;
		$data                  = self::date($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}


		if($data === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid birthday"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		try
		{

			$datetime1 = new \DateTime($data);
			$datetime2 = new \DateTime(date("Y-m-d"));

			if($datetime1 >= $datetime2)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Invalid birthday, birthday can not larger than date now!"), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}
		}
		catch (\Exception $e)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid birthday"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		return $data;
	}


	public static function datetime($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$meta           = $_meta;
		$meta['format'] = 'Y-m-d H:i:s';
		$data           = self::date($_data, $_notif, $_element, $_field_title, $meta);

		return $data;

	}


	public static function time($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{

		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		if(!is_string($data) && !is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be string or number", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(mb_strlen($data) < 2)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be larger than 2 character", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		if(mb_strlen($data) > 8)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be less than 8 character", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$data = \dash\utility\convert::to_en_number($data);


		if(preg_match("/^\d{2}\:\d{2}\:\d{2}$/", $data))
		{
			$data = $data;
		}
		elseif(preg_match("/^\d{2}\:\d{2}$/", $data))
		{
			$data = $data . ':00';
		}
		elseif(preg_match("/^\d{4}$/", $data))
		{
			$split = str_split($data);
			$data  = $split[0] . $split[1] . ':' . $split[2] . $split[3] . ':00';
		}
		elseif(preg_match("/^\d{2}$/", $data))
		{
			$split = str_split($data);
			$data  = $split[0] . $split[1] . ':00:00';
		}
		else
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid time format, Please enter the time by correct format for example 12:15", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}

}

?>

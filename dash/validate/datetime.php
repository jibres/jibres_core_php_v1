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
			}
			return false;
		}

		if(mb_strlen($data) < 2)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be larger than 2 character", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}


		if(mb_strlen($data) > 30)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be less than 30 character", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}

		$my_date_len = mb_strlen($data);

		if($my_date_len === 10)
		{
			// do nothing
		}
		elseif($my_date_len === 8 && is_numeric($my_date_len) && strpos($my_date_len, '-') === false)
		{
			// try to fix more on date as yyyy-mm-dd soon
			$convertedDate = strtotime($data);
			if ($convertedDate === false)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val is not a date field", ['val' => $_field_title]), ['element' => $_element]);
				}
				return false;
			}
			$data = date('Y-m-d', $convertedDate);
		}
		else
		{
			$convertedDate = strtotime($data);
			if ($convertedDate === false)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val is not a date field", ['val' => $_field_title]), ['element' => $_element]);
				}
				return false;
			}
			$data = date('Y-m-d', $convertedDate);
		}


		try
		{
			$convertedDate = \DateTime::createFromFormat("Y-m-d", $data);
			$data          = $convertedDate->format('Y-m-d');
		}
		catch(\Exception $e)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val is not a date field", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}


		return $data;
	}



	public static function birthdate($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{

		$data = self::date($_data, $_notif, $_element, $_field_title, $_meta);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(\dash\utility\jdate::is_jalali($data))
		{
			$data = \dash\utility\jdate::to_gregorian($data);
		}

		if($data === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid birthday"), ['element' => $_element]);
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
				}
				return false;
			}
		}
		catch(\Exception $e)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid birthday"), ['element' => $_element]);
			}
			return false;
		}


		return $data;
	}


	public static function datetime($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$meta = $_meta;
		$meta['format'] = 'Y-m-d H:i:s';
		return self::date($_data, $_notif, $_element, $_field_title, $meta);
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
			}
			return false;
		}

		if(mb_strlen($data) < 2)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be larger than 2 character", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}


		if(mb_strlen($data) > 8)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be less than 8 character", ['val' => $_field_title]), ['element' => $_element]);
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
			$data = $split[0] . $split[1]. ':'. $split[2]. $split[3]. ':00';
		}
		elseif(preg_match("/^\d{2}$/", $data))
		{
			$split = str_split($data);
			$data = $split[0] . $split[1]. ':00:00';
		}
		else
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid time format", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}

		return $data;
	}

}
?>

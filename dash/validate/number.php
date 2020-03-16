<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class number
{

	public static function number($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		if(is_string($data))
		{
			$data    = \dash\utility\convert::to_en_number($data);
			$replace = ['{', '}', '(', ')', '_', '-', '+', ' ', ','];
			$data    = str_replace($replace, '', $data);
		}

		if(!is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be a number", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}

		// infinity number
		if(is_infinite($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Number is infinite"), ['element' => $_element]);
			}
			return false;
		}

		$data = floatval($data);

		if($data > PHP_FLOAT_MAX)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Number is out of range"), ['element' => $_element]);
			}
			return false;
		}


		if(isset($_meta['min']) && is_numeric($_meta['min']))
		{
			if($data < floatval($_meta['min']))
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val must be larger than :min", ['val' => $_field_title, 'min' => \dash\fit::number($_meta['min'])]), ['element' => $_element]);
				}
				return false;
			}
		}


		if(isset($_meta['max']) && is_numeric($_meta['max']))
		{
			if($data > floatval($_meta['max']))
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val must be less than :max", ['val' => $_field_title, 'max' => \dash\fit::number($_meta['max'])]), ['element' => $_element]);
				}
				return false;
			}
		}

		return $data;
	}



	public static function price($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		return self::number($_data, $_notif, $_element, $_field_title, ['min' => 0, 'max' => 999999999999]);
	}


	public static function number_negative($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		return self::number($_data, $_notif, $_element, $_field_title, ['min' => -999999999999, 'max' => 999999999999]);
	}


	public static function int($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::number($_data, $_notif, $_element, $_field_title, ['min' => 0, 'max' => 2000000000]);
		if($data === false || $data === null)
		{
			return $data;
		}

		$data = intval($data);

		return $data;
	}


	public static function float($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::number($_data, $_notif, $_element, $_field_title, ['min' => 0, 'max' => 2000000000]);
		if($data === false || $data === null)
		{
			return $data;
		}

		$data = floatval($data);

		return $data;
	}


	public static function number_percent($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		return self::number($_data, $_notif, $_element, $_field_title, ['min' => 0, 'max' => 100]);
	}

}
?>
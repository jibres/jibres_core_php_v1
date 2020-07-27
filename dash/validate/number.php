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
				\dash\cleanse::$status = false;
			}
			return false;
		}

		// infinity number
		if(is_infinite($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Number is infinite!"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$data = floatval($data);

		if($data > PHP_FLOAT_MAX)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Number is out of range"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		if(isset($_meta['min']) && is_numeric($_meta['min']))
		{
			if($data < floatval($_meta['min']))
			{
				if($_notif)
				{
					// \dash\notif::error(T_("Field :val must be larger than :min", ['val' => $_field_title, 'min' => \dash\fit::number($_meta['min'])]), ['element' => $_element]);
					\dash\cleanse::$status = false;
					\dash\notif::error(T_("Field :val must be larger than :min character", ['val' => $_field_title, 'min' => \dash\fit::number(mb_strlen($_meta['min']))]), ['element' => $_element]);
					\dash\cleanse::$status = false;
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
					// \dash\notif::error(T_("Field :val must be less than :max", ['val' => $_field_title, 'max' => \dash\fit::number($_meta['max'])]), ['element' => $_element]);
					\dash\cleanse::$status = false;
					\dash\notif::error(T_("Field :val must be less than :max character", ['val' => $_field_title, 'max' => \dash\fit::number(mb_strlen($_meta['max']))]), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}
		}

		if(isset($_meta['round']) && $_meta['round'])
		{
			if(floatval($data) !== floatval(round($data)))
			{
				if($_notif)
				{
					// \dash\notif::error(T_("Cannot use decimal number in field :val", ['val' => $_field_title]), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
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

		$data = round($data);

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


	public static function postcode($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::number($_data, $_notif, $_element, $_field_title, ['round' => true]);
		if($data === false || $data === null)
		{
			return $data;
		}

		$data = (string) $data;

		if(mb_strlen($data) < 3)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Post code must be larger than 3 character"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		if(mb_strlen($data) > 10)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Post code must be less than 10 character"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function phone($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = self::number($_data, $_notif, $_element, $_field_title, ['round' => true]);
		if($data === false || $data === null)
		{
			return $data;
		}

		$data = (string) $data;

		if(mb_strlen($data) < 8)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Phone number must be larger than 8 character"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		if(mb_strlen($data) > 14)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Phone number must be less than 14 character"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function number_percent($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		return self::number($_data, $_notif, $_element, $_field_title, ['min' => 0, 'max' => 100]);
	}

}
?>
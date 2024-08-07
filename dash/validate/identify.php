<?php
namespace dash\validate;

class identify
{



	public static function id($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$data = \dash\validate\number::number($data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 9999999999999999999, 'force_number' => true]);

		if($data === false)
		{
			return false;
		}

		return $data;
	}


	public static function factor_id($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		if(is_string($_data) &&  substr($_data, 0, 2) === 'JF')
		{
			$_data = substr($_data, 2);
		}

		return self::id($_data, $_notif, $_element, $_field_title, $_meta);
	}


	public static function code($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}
		// max input database id is bigint(20)
		// bigint 20 in coding library = rbLvDfZ3BmXW
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 12]);

		if($data === false)
		{
			return false;
		}

		if(!\dash\coding::is($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid code"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}



	public static function store_code($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 12]);

		if($data === false)
		{
			return false;
		}

		if(!\dash\store_coding::is($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid code"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}

	public static function code_0($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		if(( is_string($_data) || is_numeric($_data) ) && (string) $_data === '0')
		{
			return null;
		}

		return self::code(...func_get_args());

	}



	public static function id_code($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$data = self::id(...func_get_args());

		if($data === false)
		{
			$data = self::code(...func_get_args());
		}

		return $data;
	}



}
?>

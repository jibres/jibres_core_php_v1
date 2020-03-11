<?php
namespace dash;
/**
 * Class for validate args
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */
class validate_old
{

	public static function string($_data)
	{
		if(!is_string($_data))
		{
			return false;
		}

		$_data = str_replace('%', '', $_data);

		return $_data;
	}



	public static function string_50($_data)
	{
		$_data = self::string($_data);

		if($_data === false)
		{
			return false;
		}

		if(mb_strlen($_data) > 50)
		{
			return false;
		}

		return $_data;
	}



	public static function string_200($_data)
	{
		$_data = self::string($_data);

		if($_data === false)
		{
			return false;
		}

		if(mb_strlen($_data) > 200)
		{
			return false;
		}

		return $_data;
	}



	public static function string_long($_data)
	{
		$_data = self::string($_data);

		if($_data === false)
		{
			return false;
		}

		if(mb_strlen($_data) > 5000)
		{
			return false;
		}

		return $_data;
	}



	public static function enum($_data, $_field)
	{
		$_data = self::string($_data);

		if($_data === false)
		{
			return false;
		}

		if(!in_array($_data, $_field))
		{
			return false;
		}

		return $_data;
	}


	public static function datetime($_data)
	{
		return $_data;
	}


	public static function time($_data)
	{
		return $_data;
	}


	public static function price($_data)
	{
		return $_data;
	}


	public static function barcode($_data)
	{
		return $_data;
	}


	public static function mobile($_data)
	{
		if($_data === null || $_data === '')
		{
			return null;
		}

		if(!is_string($_data) || !is_numeric($_data))
		{
			return false;
		}


		$_data = \dash\utility\filter::mobile($_data);
		if(!$_data)
		{
			return false;
		}

		return $_data;
	}


	public static function phone($_data)
	{
		return $_data;
	}

	public static function code($_data)
	{
		return $_data;
	}


	public static function address($_data)
	{
		return $_data;
	}

	public static function password($_data)
	{
		return $_data;
	}
}
?>
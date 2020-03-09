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
class validate
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
		return $_data;
	}


	public static function phone($_data)
	{
		return $_data;
	}


	public static function address($_data)
	{
		return $_data;
	}
}
?>
<?php
namespace dash\setting;


class zarinpal
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/payment_zarinpal.secret.json');
			if($json && is_string($json))
			{
				$json = json_decode($json, true);
			}

			if(!is_array($json))
			{
				$json = [];
			}
			self::$load = $json;

		}

	}


	public static function get($_key = null)
	{

		if(\dash\engine\store::inStore())
		{
			$temp_key = 'payment_setting_'. substr(strrchr(__CLASS__, "\\"), 1);
			self::$load = \dash\temp::get($temp_key);
		}
		else
		{
			self::load();
		}


		if($_key === null)
		{
			return self::$load;
		}

		// bug fix: TypeError(array_key_exists(): Argument #2 ($array) must be of type array, null given)
		if(!is_array(self::$load))
		{
			return null;
		}

		if(array_key_exists($_key, self::$load))
		{
			return self::$load[$_key];
		}

		return null;
	}
}
?>
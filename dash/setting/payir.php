<?php
namespace dash\setting;


class payir
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			if(\dash\url::isLocal())
			{
				$json = \dash\file::read(__DIR__. '/secret/payment_payir_local.secret.json');
			}
			else
			{
				$json = \dash\file::read(__DIR__. '/secret/payment_payir.secret.json');
			}
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

		self::load();

		if($_key === null)
		{
			return self::$load;
		}

		if(array_key_exists($_key, self::$load))
		{
			return self::$load[$_key];
		}

		return null;
	}
}
?>
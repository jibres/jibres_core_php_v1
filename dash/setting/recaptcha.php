<?php
namespace dash\setting;


class recaptcha
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/recaptcha.secret.json');
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

	private static function whereami()
	{
		if(\dash\engine\store::inStore())
		{
			return 'business';
		}
		else
		{
			if(\dash\url::domain() === 'jibres.com')
			{
				return 'com';
			}
			else
			{
				return 'ir';
			}
		}
	}


	public static function secret_v3()
	{
		self::load();

		$in = self::whereami();

		if(isset(self::$load['v3'][$in]['secret']))
		{
			return self::$load['v3'][$in]['secret'];
		}
	}


	public static function secret_v2()
	{
		self::load();

		$in = self::whereami();

		if(isset(self::$load['v2'][$in]['secret']))
		{
			return self::$load['v2'][$in]['secret'];
		}
	}


	public static function sitekey_v3()
	{
		self::load();

		$in = self::whereami();

		if(isset(self::$load['v3'][$in]['sitekey']))
		{
			return self::$load['v3'][$in]['sitekey'];
		}
	}

}
?>
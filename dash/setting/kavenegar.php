<?php
namespace dash\setting;


class kavenegar
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/kavenegar.secret.json');
			if($json && is_string($json))
			{
				$json = json_decode($json, true);
			}

			if(!is_array($json))
			{
				$json = [];
			}

			// load store setting
			if(\dash\engine\store::inStore())
			{
				$sms_setting = \lib\app\setting\get::sms_setting();
				if(isset($sms_setting['kavenegar_apikey']) && $sms_setting['kavenegar_apikey'])
				{
					$json['apikey'] = $sms_setting['kavenegar_apikey'];
					$json['line']   = null;
				}
				else
				{
					$json['apikey'] = $json['business_apikey'];
					$json['line']   = $json['business_line'];
				}
			}

			self::$load = $json;

		}

	}


	public static function apikey($_business_mode = false)
	{
		self::load();

		if($_business_mode)
		{
			return a(self::$load, 'business_apikey');
		}

		if(isset(self::$load['apikey']))
		{
			return self::$load['apikey'];
		}

		return null;
	}


	public static function line($_business_mode = false)
	{
		self::load();

		if($_business_mode)
		{
			return a(self::$load, 'business_line');
		}

		if(isset(self::$load['line']))
		{
			return self::$load['line'];
		}

		return null;
	}
}
?>
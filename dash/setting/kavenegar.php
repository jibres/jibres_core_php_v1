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
				}
			}

			self::$load = $json;

		}

	}


	public static function apikey()
	{
		self::load();
		if(isset(self::$load['apikey']))
		{
			return self::$load['apikey'];
		}

		return null;
	}
}
?>
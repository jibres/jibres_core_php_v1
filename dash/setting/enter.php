<?php
namespace dash\setting;


class enter
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			$json = \dash\file::read(__DIR__. '/secret/enter.secret.json');
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




	public static function su_access()
	{
		self::load();

		if(isset(self::$load['su_access']))
		{
			return self::$load['su_access'];
		}

		return false;
	}
}
?>
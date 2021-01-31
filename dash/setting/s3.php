<?php
namespace dash\setting;


class s3
{

	private static $load = null;


	private static function load()
	{
		if(self::$load === null)
		{
			if(\dash\engine\store::inStore())
			{
				if(\lib\store::detail('special_upload_provider'))
				{
					$json = \lib\app\setting\get::upload_provider();
				}
				else
				{
					$json = [];
				}
			}
			else
			{
				$json = \dash\file::read(__DIR__. '/secret/s3.secret.json');
				if($json && is_string($json))
				{
					$json = json_decode($json, true);
				}
			}

			if(!is_array($json))
			{
				$json = [];
			}

			self::$load = $json;
		}

	}


	private static function active_service()
	{
		if(is_array(self::$load))
		{
			foreach (self::$load as $key => $value)
			{
				if(isset($value['status']) && $value['status'])
				{
					return $key;
				}
			}
		}

		return null;
	}


	public static function status($_service = null)
	{
		self::load();

		if(is_null($_service))
		{
			$_service = self::active_service();
		}

		if(isset(self::$load[$_service]['status']))
		{
			return self::$load[$_service]['status'];
		}

		return false;
	}


	public static function accesskey($_service = null)
	{
		self::load();

		if(is_null($_service))
		{
			$_service = self::active_service();
		}

		if(isset(self::$load[$_service]['accesskey']))
		{
			return self::$load[$_service]['accesskey'];
		}

		return false;
	}


	public static function secretkey($_service = null)
	{
		self::load();

		if(is_null($_service))
		{
			$_service = self::active_service();
		}

		if(isset(self::$load[$_service]['secretkey']))
		{
			return self::$load[$_service]['secretkey'];
		}

		return false;
	}



	public static function region($_service = null)
	{
		self::load();

		if(is_null($_service))
		{
			$_service = self::active_service();
		}

		$region = null;

		if(isset(self::$load[$_service]['region']))
		{
			$region = self::$load[$_service]['region'];
		}

		if(!$region)
		{
			if($_service === 'digitalocean')
			{
				$region = 'us-east-1';
				// $region = 'nyc3';
			}
			else
			{
				$region = '';
			}
		}

		return $region;
	}



	public static function bucket($_service = null)
	{
		self::load();

		if(is_null($_service))
		{
			$_service = self::active_service();
		}

		if(isset(self::$load[$_service]['bucket']))
		{
			return self::$load[$_service]['bucket'];
		}

		return false;
	}


	public static function endpoint($_service = null)
	{
		self::load();

		if(is_null($_service))
		{
			$_service = self::active_service();
		}

		if(isset(self::$load[$_service]['endpoint']))
		{
			return self::$load[$_service]['endpoint'];
		}

		return false;
	}
}
?>
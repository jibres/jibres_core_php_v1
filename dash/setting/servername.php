<?php
namespace dash\setting;


class servername
{
	private static $load = null;


	private static function load()
	{
		if(!self::$load)
		{
			$detail = \dash\file::read(__DIR__. '/secret/servername.secret.json');
			if($detail && is_string($detail))
			{
				$detail = json_decode($detail, true);
			}

			if(!is_array($detail))
			{
				$detail = [];
			}

			self::$load = $detail;
		}
	}


	public static function code($_ip)
	{
		$get = self::detail($_ip);

		if(isset($get['code']))
		{
			return $get['code'];
		}

		return null;
	}


	public static function detail($_ip)
	{
		self::load();

		if(isset(self::$load[$_ip]))
		{
			return self::$load[$_ip];
		}

		return null;
	}


	public static function get_list()
	{
		self::load();

		if(is_array(self::$load))
		{
			return self::$load;
		}

		return [];
	}



	public static function current_detail()
	{
		self::load();

		$hostname = gethostname();

		foreach (self::$load as $key => $value)
		{
			if(isset($value['hostname']) && $value['hostname'] === $hostname)
			{
				return $value;
			}
		}
		return null;
	}



	public static function dns_provider()
	{
		self::load();

		$list = [];

		if(is_array(self::$load))
		{
			foreach (self::$load as $key => $value)
			{
				if(isset($value['dns_provider']) && $value['dns_provider'])
				{
					$list[$key] = $value;
				}
			}
		}

		return $list;
	}


	public static function database()
	{
		self::load();

		$list = [];

		if(is_array(self::$load))
		{
			foreach (self::$load as $key => $value)
			{
				if(isset($value['database']) && $value['database'])
				{
					$list[$key] = $value;
				}
			}
		}

		return $list;
	}

}
?>
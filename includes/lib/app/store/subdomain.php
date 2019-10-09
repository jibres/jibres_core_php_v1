<?php
namespace lib\app\store;


class subdomain
{
	private static $debug = true;

	public static function validate_exist($_subdomain)
	{
		self::$debug = false;

		$subdomain = self::validate($_subdomain);
		if(!$subdomain)
		{
			return false;
		}

		$check_exist = \lib\db\store\check::subdomain_exist($subdomain);
		if($check_exist)
		{
			return false;
		}

		return true;
	}


	public static function validate($_subdomain)
	{
		$_subdomain = \dash\utility\convert::to_en_number($_subdomain);
		$_subdomain = mb_strtolower($_subdomain);
		$_subdomain = trim($_subdomain);
		$_subdomain = preg_replace("/\_{2,}/", "_", $_subdomain);
		$_subdomain = preg_replace("/\-{2,}/", "-", $_subdomain);

		if(mb_strlen($_subdomain) < 5)
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("Slug must have at least 5 character"), 'subdomain');
			}
			return false;
		}

		if(mb_strlen($_subdomain) > 50)
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("Please set the subdomain less than 50 character"), 'subdomain');
			}
			return false;
		}

		if(!preg_match("/^[A-Za-z0-9\-\_]+$/", $_subdomain))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("Only [A-Za-z0-9-_] can use in subdomain"), 'subdomain');
			}
			return false;
		}

		if(is_numeric($_subdomain))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("Slug should contain a Latin letter"), 'subdomain');
			}
			return false;
		}

		if(is_numeric(substr($_subdomain, 0, 1)))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("The subdomain must begin with latin letters"), 'subdomain');
			}
			return false;
		}

		if(substr_count($_subdomain, '-') > 1)
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("The subdomain must have one separator"), 'subdomain');
			}
			return false;
		}

		if(substr_count($_subdomain, '_') > 1)
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("The subdomain must have one separator"), 'subdomain');
			}
			return false;
		}

		if(strpos($_subdomain, 'jibres') !== false)
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("Can not use subdomain by jibres keyword"), 'subdomain');
			}
			return false;
		}

		if(self::badwords($_subdomain))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), 'subdomain');
			}
			return false;
		}

		if(self::famous_site($_subdomain))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), 'subdomain');
			}
			return false;
		}

		if(self::subdomain($_subdomain))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), 'subdomain');
			}
			return false;
		}

		if(self::jibres($_subdomain))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), 'subdomain');
			}
			return false;
		}

		if(self::verybadwords($_subdomain))
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), 'subdomain');
			}
			return false;
		}

		return $_subdomain;
	}


	private static function badwords($_subdomain)
	{
		return self::blacklist($_subdomain, 'badwords');
	}


	private static function famous_site($_subdomain)
	{
		return self::blacklist($_subdomain, 'famous_site');
	}


	private static function subdomain($_subdomain)
	{
		return self::blacklist($_subdomain, 'subdomain');
	}


	private static function jibres($_subdomain)
	{
		$list = self::blacklist($_subdomain, 'jibres', true);
		if($list && is_array($list))
		{
			foreach ($list as $key => $keyword)
			{
				if(strpos($_subdomain, $keyword) !== false)
				{
					return true;
				}
			}
		}

		return false;
	}


	private static function verybadwords($_subdomain)
	{
		$list = self::blacklist($_subdomain, 'verybadwords', true);
		if($list && is_array($list))
		{
			foreach ($list as $key => $keyword)
			{
				if(strpos($_subdomain, $keyword) !== false)
				{
					return true;
				}
			}
		}

		return false;
	}


	private static function blacklist($_subdomain, $_file_name, $_return_file = false)
	{
		$file = \dash\file::read(__DIR__. '/blacklist/'. $_file_name. '.txt');

		if($file)
		{
			$get = explode("\n", $file);
			if(is_array($get))
			{
				if($_return_file)
				{
					return $get;
				}
				else
				{
					return in_array($_subdomain, $get);
				}
			}
		}

		return false;
	}
}
?>
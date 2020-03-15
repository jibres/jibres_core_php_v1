<?php
namespace dash\validate;


class subdomain
{

	public static function subdomain($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$meta        = $_meta;
		$meta['min'] = 5;
		$meta['max'] = 50;

		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, $meta);

		if($data === false || $data === null)
		{
			return $data;
		}


		if(!$data)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Please fill subdomain"), ['element' => $_element]);
			}
			return false;
		}

		$data = \dash\utility\convert::to_en_number($data);
		$data = mb_strtolower($data);
		$data = preg_replace("/\_{2,}/", "_", $data);
		$data = preg_replace("/\-{2,}/", "-", $data);
		$data = trim($data, '-');
		$data = trim($data, '_');
		$data = trim($data);

		if(mb_strlen($data) < 5)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Slug must have at least 5 character"), ['element' => $_element]);
			}
			return false;
		}

		if(mb_strlen($data) > 50)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Please set the subdomain less than 50 character"), ['element' => $_element]);
			}
			return false;
		}

		if(!preg_match("/^[A-Za-z0-9\-\_]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only [A-Za-z0-9-_] can use in subdomain"), ['element' => $_element]);
			}
			return false;
		}

		if(is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Slug should contain a Latin letter"), ['element' => $_element]);
			}
			return false;
		}

		if(is_numeric(substr($data, 0, 1)))
		{
			if($_notif)
			{
				\dash\notif::error(T_("The subdomain must begin with latin letters"), ['element' => $_element]);
			}
			return false;
		}

		if(substr_count($data, '-') > 1)
		{
			if($_notif)
			{
				\dash\notif::error(T_("The subdomain must have one separator"), ['element' => $_element]);
			}
			return false;
		}

		if(substr_count($data, '_') > 1)
		{
			if($_notif)
			{
				\dash\notif::error(T_("The subdomain must have one separator"), ['element' => $_element]);
			}
			return false;
		}

		if(strpos($data, 'jibres') !== false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Can not use subdomain by jibres keyword"), ['element' => $_element]);
			}
			return false;
		}

		if(self::blacklist($data, 'badwords'))
		{
			if($_notif)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), ['element' => $_element]);
			}
			return false;
		}

		if(self::blacklist($data, 'famous_site'))
		{
			if($_notif)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), ['element' => $_element]);
			}
			return false;
		}

		if(self::blacklist($data, 'subdomain'))
		{
			if($_notif)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), ['element' => $_element]);
			}
			return false;
		}

		if(self::jibres($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), ['element' => $_element]);
			}
			return false;
		}

		if(self::verybadwords($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("You can not choose this subdomain"), ['element' => $_element]);
			}
			return false;
		}

		return $data;
	}




	private static function jibres($_data)
	{
		$list = self::blacklist($_data, 'jibres', true);
		if($list && is_array($list))
		{
			foreach ($list as $key => $keyword)
			{
				if(strpos($_data, $keyword) !== false)
				{
					return true;
				}
			}
		}

		return false;
	}


	private static function verybadwords($_data)
	{
		$list = self::blacklist($_data, 'verybadwords', true);
		if($list && is_array($list))
		{
			foreach ($list as $key => $keyword)
			{
				if(strpos($_data, $keyword) !== false)
				{
					return true;
				}
			}
		}

		return false;
	}


	private static function blacklist($_data, $_file_name, $_return_file = false)
	{
		$file = \dash\file::read(\autoload::fix_os_path(__DIR__. '/subdomain_blacklist/'. $_file_name. '.txt'));

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
					return in_array($_data, $get);
				}
			}
		}

		return false;
	}
}
?>
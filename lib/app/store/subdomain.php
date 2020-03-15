<?php
namespace lib\app\store;


class subdomain
{
	public static $subdomain_field_name = 'subdomain';
	public static $debug = true;

	public static function validate_exist($_subdomain)
	{
		$subdomain = \dash\validate::subdomain($_subdomain, self::$debug, ['element' => self::$subdomain_field_name, 'field_title' =>  'subdomain']);
		if(!$subdomain)
		{
			return false;
		}

		$check_exist = \lib\db\store\get::subdomain_exist($subdomain);
		if($check_exist)
		{
			if(self::$debug)
			{
				\dash\notif::error(T_("This subdomain is already occupied"), self::$subdomain_field_name);
			}
			return false;
		}

		return true;
	}
}
?>
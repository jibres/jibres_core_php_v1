<?php
namespace lib\app\nic_domain;


class check
{

	public static function check($_domain)
	{
		$_domain = \dash\validate::domain($_domain);
		if(!$_domain)
		{
			return false;
		}

		$result = \lib\nic\exec\domain_check::check($_domain);

		\lib\app\domains\detect::domain('check', $_domain, $result);

		return $result;

	}


	public static function info($_domain)
	{
		$_domain = \dash\validate::domain($_domain);
		if(!$_domain)
		{
			return false;
		}


		$result = \lib\nic\exec\domain_info::info($_domain);

		\lib\app\domains\detect::domain_info($_domain, $result);

		if(!isset($result[$_domain]))
		{
			\dash\notif::error(T_("Domain not found"));
			return false;
		}
		return $result[$_domain];

	}
}
?>
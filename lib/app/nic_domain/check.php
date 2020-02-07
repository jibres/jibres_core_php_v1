<?php
namespace lib\app\nic_domain;


class check
{
	public static function syntax($_domain)
	{
		if(!$_domain)
		{
			\dash\notif::error(T_("Please fill domain"), 'domain');
			return false;
		}

		return true;

	}

	public static function check($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain::check($_domain);

		return $result;

	}
}
?>
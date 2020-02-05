<?php
namespace lib\nic\app\domain;


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
}
?>
<?php
namespace lib\app\nic_domain;


class lock
{
	public static function lock($_domain)
	{

		if(!\dash\user::id())
		{
			return;
		}

		if(!$_domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}


		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		$result = \lib\nic\exec\domain_lock::lock($_domain);
		if($result)
		{
			$_domain_id = \lib\db\nic_domain\update::update(['lock' => 1], $load_domain['id']);

			\dash\notif::ok(T_("Domain is locked"));
			return true;

		}

		\dash\notif::error(T_("Can not lock your domain"));
		return false;

	}
}
?>
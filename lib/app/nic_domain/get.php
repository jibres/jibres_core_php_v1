<?php
namespace lib\app\nic_domain;


class get
{
	public static function is_my_domain($_domain)
	{
		if(!$_domain)
		{
			\dash\notif::error(T_("Please fill domain"), 'domain');
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}


		$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}
		return $load_domain;


	}

	public static function check($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_check::check($_domain);

		return $result;

	}


	public static function info($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_info::info($_domain);

		return $result;

	}



	public static function by_id($_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\db\nic_domain\get::by_id_user_id($_id, \dash\user::id());

		if(!$load)
		{
			\dash\notif::error(T_("Domain not found"));
			return false;
		}

		return $load;

	}
}
?>
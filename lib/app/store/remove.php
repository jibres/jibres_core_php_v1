<?php
namespace lib\app\store;


class remove
{

	public static function remove($_args)
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!isset($_args['subdomain']))
		{
			\dash\notif::error(T_("Please enter the subdomain"), 'subdomain');
			return false;
		}

		$subdomain = $_args['subdomain'];
		$subdomain = \dash\validate::string_200($subdomain, false);

		if(!$subdomain)
		{
			\dash\notif::error(T_("Please enter the subdomain"), 'subdomain');
			return false;
		}

		if(!\dash\permission::is_admin())
		{
			\dash\notif::error(T_("You can not access to remove business!"), 'subdomain');
			return false;
		}

		if($subdomain === \lib\store::detail('subdomain'))
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid subdomain!"), 'subdomain');
			return false;
		}

		\dash\log::to_supervisor('User remove business '. $subdomain);

		\lib\app\setting\tools::save('remove_business', 'by_user', \dash\user::id());

		\lib\db\store\update::set_deleted($store_id);

		\lib\store::reset_cache($store_id, $subdomain);

		\dash\notif::ok(T_("Your business was removed"));

		return true;
	}

	public static function back($_store_id)
	{
		$store_id = \dash\validate::id($_store_id);
		if(!$store_id)
		{
			return false;
		}

		\lib\db\store\update::set_enable($store_id);

		\lib\store::reset_cache($store_id);

		\dash\notif::ok(T_("Store was enabled"));
		return true;
	}

}
?>
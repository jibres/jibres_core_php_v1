<?php
namespace lib\app\business_domain;

class remove
{
	public static function remove($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$id = $load['id'];

		if(isset($load['domain_id']) && $load['domain_id'])
		{
			\lib\app\business_domain\edit::edit_raw(['status' => 'pending', 'store_id' => null], $load['id']);
		}
		else
		{
			$remove_from_cdn_panel = \lib\app\business_domain\cdnpanel::remove($id);
			if($remove_from_cdn_panel)
			{
				\lib\store::reset_cache($load['store_id']);
				\lib\app\business_domain\business::reset_list($load['store_id']);

				// \lib\db\business_domain\delete::all_domain_action($id);
				// \lib\db\business_domain\delete::all_domain_dns($id);
				// \lib\db\business_domain\delete::by_id($id);
				\lib\app\business_domain\edit::edit_raw(['status' => 'deleted'], $id);
			}
		}

		\dash\notif::delete(T_("Domain removed"));

		return true;
	}


	public static function remove_full($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$id = $load['id'];

		// $remove_from_cdn_panel = \lib\app\business_domain\cdnpanel::remove($id);
		\lib\app\business_domain\business::reset_list($load['store_id']);
		\lib\db\business_domain\delete::all_domain_action($id);
		\lib\db\business_domain\delete::all_domain_dns($id);
		\lib\db\business_domain\delete::by_id($id);


		\dash\notif::delete(T_("Domain removed"));

		return true;
	}


	public static function force_remove($_id)
	{
		$remove_from_cdn_panel = \lib\app\business_domain\cdnpanel::remove($_id);
		if($remove_from_cdn_panel)
		{
			\lib\app\business_domain\edit::edit_raw(['status' => 'deleted'], $_id);
			// \lib\db\business_domain\delete::all_domain_action($_id);
			// \lib\db\business_domain\delete::all_domain_dns($_id);
			// \lib\db\business_domain\delete::by_id($_id);
		}
	}


	public static function remove_by_user($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}


		$all_domain_name = \lib\app\business_domain\get::my_all_domains();


		if(isset($load['master']) && $load['master'] && is_array($all_domain_name) && count($all_domain_name) >= 2)
		{
			\dash\notif::error(T_("You can not remove master Domain. Please change your business master domain and try it later"));
			return false;
		}

		$id = $load['id'];


		$force_remove = false;
		if(isset($load['subdomain']) && $load['subdomain'])
		{
			$force_remove = true;
		}

		if(!a($load, 'dnsok'))
		{
			$force_remove = true;
		}

		if(!a($load, 'cdnpanel'))
		{
			$force_remove = true;
		}

		if($force_remove)
		{
			self::remove($_id);
			\dash\notif::clean();
			\dash\engine\process::continue();
		}
		else
		{
			\lib\app\business_domain\edit::edit_raw(['status' => 'pending_delete'], $id);
		}

		\dash\notif::delete(T_("Domain removed"));

		return true;
	}


}
?>
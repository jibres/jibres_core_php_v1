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


		$remove_from_cdn_panel = \lib\app\business_domain\cdnpanel::remove($id);
		if($remove_from_cdn_panel)
		{
			\lib\store::reset_cache($load['store_id']);

			\lib\db\business_domain\delete::all_domain_action($id);
			\lib\db\business_domain\delete::all_domain_dns($id);
			\lib\db\business_domain\delete::by_id($id);


			\dash\notif::delete(T_("Domain removed"));
		}
		return true;
	}


	public static function remove_by_user($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$id = $load['id'];

		\lib\app\business_domain\edit::edit_raw(['status' => 'pending_delete'], $id);

		\dash\notif::delete(T_("Domain removed"));
		return true;
	}


}
?>
<?php
namespace lib\app\business_domain;


class get
{
	public static function my_store_domain($_domain)
	{
		$store_id = \lib\store::id();

		if(!$store_id)
		{
			return false;
		}

		$domain = \dash\validate::domain($_domain);

		$load = \lib\db\business_domain\get::by_store_id_domain($store_id, $domain);

		if(!$load)
		{
			return false;
		}

		$load = \lib\app\business_domain\ready::row($load);

		return $load;
	}


	public static function get($_id)
	{

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \lib\db\business_domain\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Domain detail not found"));
			return false;
		}

		$load = \lib\app\business_domain\ready::row($load);

		return $load;
	}
}
?>
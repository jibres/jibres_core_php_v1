<?php
namespace lib\app\business_domain;


class edit
{
	public static function set_date($_id, $_field)
	{
		$result = \lib\db\business_domain\update::update([$_field => date("Y-m-d H:i:s"), 'datemodified' => date("Y-m-d H:i:s")], $_id);
	}

	public static function unset_date($_id, $_field)
	{
		$result = \lib\db\business_domain\update::update([$_field => null, 'datemodified' => date("Y-m-d H:i:s")], $_id);
	}


	public static function edit_raw($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$result = \lib\db\business_domain\update::update($_args, $_id);
	}


	public static function dns_set_status($_dns_id, $_status)
	{
		return self::dns_edit(['status' => $_status], $_dns_id);
	}

	public static function dns_edit($_args, $_dns_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");
		$result = \lib\db\business_domain\update::update_dns($_args, $_dns_id);
	}


	public static function changemaster($_domain_id)
	{
		$_domain_id = \dash\validate::id($_domain_id);

		$store_id = \lib\store::id();
		if(!$store_id)
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\lib\db\business_domain\update::reset_all_master_store($store_id);

		$result = \lib\db\business_domain\update::update_id_store_id(['master' => 1, 'datemodified' => date("Y-m-d H:i:s")], $_domain_id, $store_id);

		\lib\store::reset_cache();

		\dash\notif::ok(T_("Your business master domain set"));

		return true;
	}


	public static function edit($_args, $_id)
	{
		$condition =
		[
			'cdn'   => ['enum' => ['arvancloud', 'cloudflare', 'enterprise']],
		];

		$require = ['cdn'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$id = \dash\validate::id($_id);

		$data['datemodified'] = date("Y-m-d H:i:s");

		$result = \lib\db\business_domain\update::update($data, $id);

		\dash\notif::ok(T_("Domain record updated"));
		return true;

	}

}
?>
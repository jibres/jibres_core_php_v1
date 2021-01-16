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

		// load detail and if have store_id
		$load = \lib\db\business_domain\get::by_id($_id);
		if(isset($load['store_id']))
		{
			\lib\app\business_domain\business::reset_list($load['store_id']);
		}
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


	public static function reset_redirect_domain_setting($_new_option = null, $_set = null)
	{
		if(\lib\store::id())
		{
			$store_id = \lib\store::id();
			if($_set)
			{
				if($_new_option)
				{
					\lib\db\business_domain\update::reset_all_redirect_store($store_id, 1);
				}
				else
				{
					\lib\db\business_domain\update::reset_all_redirect_store($store_id, 0);
				}
			}
			else
			{
				$check_default_before = \lib\store::detail('redirect_all_domain_to_master');

				if($check_default_before)
				{
					\lib\db\business_domain\update::reset_all_redirect_store($store_id, 1);
				}
				else
				{
					\lib\db\business_domain\update::reset_all_redirect_store($store_id, 0);
				}
			}

			\lib\store::reset_cache();

			\lib\app\business_domain\business::reset_list($store_id);
		}
	}

	public static function set_my_master($_domain)
	{
		$load = \lib\app\business_domain\get::my_store_domain($_domain);
		if(!$load || !isset($load['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		return self::changemaster($load['id']);
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

		\lib\app\business_domain\business::reset_list($store_id);

		\dash\notif::ok(T_("Your business master domain set"));

		return true;
	}


	public static function edit($_args, $_id)
	{
		$condition =
		[
			'cdn'    => ['enum' => ['arvancloud', 'cloudflare', 'enterprise']],
			'status' => ['enum' => ['pending','failed','ok','pending_delete','deleted','inprogress','dns_not_resolved']],
		];

		$require = ['cdn', 'status'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$id = \dash\validate::id($_id);

		$data = \dash\cleanse::patch_mode($_args, $data);

		$result = self::edit_raw($data, $id);

		\dash\notif::ok(T_("Domain record updated"));
		return true;

	}

}
?>
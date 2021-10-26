<?php
namespace lib\app\plugin;

/**
 * Add plugin by admin to business
 */
class admin
{
	public static function add($_business_id, $_plugin)
	{

		$business_id = \dash\validate::id($_business_id);
		$plugin = \dash\validate::string_100($_plugin);

		if(!$business_id || !$plugin)
		{
			\dash\notif::error(T_("Business or plugin is required"));
			return false;
		}

		$check = \lib\db\store_plugin\get::by_business_id_plugin($business_id, $plugin);

		if(isset($check['id']))
		{
			if(a($check, 'status') === 'enable')
			{
				\dash\notif::error(T_("This plugin already enable on this business"));
				return;
			}

			\lib\db\store_plugin\update::record(['status' => 'enable', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));

			\dash\notif::ok(T_("Feature exist. Re Enabled"));
		}
		else
		{
			$price  = floatval(get::price($plugin));

			$insert =
			[
				'store_id'    => $_business_id,
				'plugin_key' => $plugin,
				'zone'        => get::zone($plugin),
				'status'      => 'enable',
				'addedby'     => 'admin',
				'user_id'     => \dash\user::id(),
				'price'       => $price,
				'finalprice'  => $price,
				'datecreated' => date("Y-m-d H:i:s"),
			];

			\lib\db\store_plugin\insert::new_record($insert);

			\dash\notif::ok(T_("Feature added"));
		}



		// send request to api.busisness.jibres to alert him the plugin is payed

		\lib\jpi\bpi::sync_required($business_id);


		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_plugin_add_by_admin' => true,
			'my_plugin_key'          => $plugin,
			'my_business_id'          => $business_id,
			'my_user_id'              => \dash\user::id(),
			'my_business_title'       => a($load_busness_detail, 'title'),

		];

		\dash\log::set('business_plugin', $log);

	}

	public static function remove($_business_id, $_plugin)
	{

		$business_id = \dash\validate::id($_business_id);
		$plugin = \dash\validate::string_100($_plugin);

		if(!$business_id || !$plugin)
		{
			\dash\notif::error(T_("Business or plugin is required"));
			return false;
		}

		$check = \lib\db\store_plugin\get::by_business_id_plugin($business_id, $plugin);

		if(isset($check['id']))
		{
			if(a($check, 'status') === 'enable')
			{
				\lib\db\store_plugin\update::record(['status' => 'deleted', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));
				\dash\notif::ok(T_("Feature removed"));
			}
			else
			{
				\dash\notif::warn(T_("Feature already removed"));
				return false;
			}


		}
		else
		{
			\dash\notif::error(T_("Feature not exist"));
			return false;
		}



		// send request to api.busisness.jibres to alert him the plugin is payed

		\lib\jpi\bpi::sync_required($business_id);

		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_plugin_removed' => true,
			'my_plugin_key'     => $plugin,
			'my_business_id'     => $business_id,
			'my_user_id'         => \dash\user::id(),
			'my_business_title'  => a($load_busness_detail, 'title'),

		];

		\dash\log::set('business_plugin', $log);


	}
}
?>
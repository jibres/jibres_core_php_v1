<?php
namespace lib\app\plugin;

/**
 * This class describes a pay.
 * This class call from api
 */
class activate
{
	/**
	 * Activate plugin by user
	 *
	 * @param      <type>      $_business_id  The business identifier
	 * @param      <type>      $_plugin       The plugin
	 * @param      array       $_args         The arguments
	 *
	 * @return     array|bool  ( description_of_the_return_value )
	 */
	public static function activate($_business_id, $_args = [])
	{
		$condition =
		[
			'plugin'     => 'string_200',
			'periodic'   => 'string_200',
			'use_budget' => 'bit',
			'turn_back'  => 'string_2000',
		];

		$require = ['plugin', 'turn_back'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		/**
		 * @author reza
		 *
		 * Validate plugin
		 * Check is enable or not expire
		 * Get type (once or periodic)
		 * Calculate price (by something like date relase, gift code, festival, ...)
		 * Load business plugin by like this name
		 * If have business plugin load all plugin action
		 * If plugin type is once and plugin is activated generate error and return. else activate this plugin after minus transaction
		 * If plugin type is periodic append date to plugin and add new action
		 *
		 * In the future manage refund and expire plugin in this function
		 */

		$plugin = $data['plugin'];

		// load plugin detail
		$plugin_detail = \lib\app\plugin\get::detail($plugin);
		if(!$plugin_detail)
		{
			\dash\notif::error(T_("Invalid plugin!"));
			return false;
		}

		// detect plugin type
		$plugin_type = 'once';
		if(a($plugin_detail, 'type') && is_string($plugin_detail['type']))
		{
			$plugin_type = $plugin_detail['type'];
		}

		$price = \lib\app\plugin\get::price($plugin);


		$user_id = \dash\user::id();

		\dash\pdo::transaction();

		$is_activated_in_business = \lib\db\store_plugin\get::by_business_id_lock($_business_id, $plugin);

		if(!is_array($is_activated_in_business))
		{
			$is_activated_in_business = [];
		}

		// plugin id
		$plugin_id = null;

		// is activated before.
		// need check something in action
		$current_actions = [];

		// if last action is pending needless to add new pending action
		$last_action_pending     = [];

		if(isset($is_activated_in_business['id']))
		{
			// set plugin id
			$plugin_id = $is_activated_in_business['id'];

			var_dump($is_activated_in_business);exit;

			$last_action_pending = \lib\db\store_plugin\get::get_last_action_pending($is_activated_in_business['id']);

			$current_actions = \lib\db\store_plugin\get::get_current_actions($is_activated_in_business['id']);
		}
		else
		{
			// need to add new record in store plugin

			$insert =
			[
				'store_id'    => $_business_id,
				'plugin'      => $plugin,
				'zone'        => \lib\app\plugin\get::zone($plugin),
				'status'      => 'pending',
				'datecreated' => date("Y-m-d H:i:s"),
			];

			$plugin_id = \lib\db\store_plugin\insert::new_record($insert);

			if(!$plugin_id)
			{
				\dash\pdo::rollback();
				\dash\log::oops('ErrorInAddNewPlugin', T_("Can not add this plugin. Please contact to administrator"));
				return false;
			}
		}

		if(!$last_action_pending)
		{
			$insert_action =
			[
				'plugin_id'   => $id,
				'addedby'     => 'user',
				'user_id'     => $user_id,
				'price'       => $price,
				'finalprice'  => $price,
				'status'      => 'pending',
				'datecreated' => date("Y-m-d H:i:s"),
			];

			$action_id = \lib\db\store_plugin_action\insert::new_record($insert);
			if(!$action_id)
			{
				\dash\pdo::rollback();
				\dash\log::oops('ErrorInAddNewPluginAction', T_("Can not add this action. Please contact to administrator"));
				return false;
			}
		}

		\dash\pdo::commit();

		$pay_price = $price;

		if($pay_price)
		{
			// check use ad budget
			if(isset($_args['use_budget']) && $_args['use_budget'])
			{
				$user_budget = \dash\user::budget();

				$remain_amount = $pay_price - floatval($user_budget);
				if($remain_amount >= 0)
				{
					$pay_price = $remain_amount;
				}
				else
				{
					$pay_price = 0;
				}
			}
		}

		$result = [];

		$turn_back = \dash\url::kingdom();
		if(isset($_args['turn_back']) && is_string($_args['turn_back']))
		{
			$turn_back = $_args['turn_back'];
		}

		$temp_args                = [];
		$temp_args['plugin']      = $calculate_price;
		$temp_args['user_id']     = $user_id;
		$temp_args['business_id'] = $_business_id;
		$temp_args['page_url']    = a($_args, 'page_url');

		if($pay_price > 0)
		{
			// generate pay link

			// go to bank
			$meta =
			[
				'pay_on_jibres' => true,
				'msg_go'        => T_("Activate plugin :val", ['val' => \lib\app\plugin\get::title($plugin)]),
				'auto_go'       => false,
				'auto_back'     => true,
				'final_msg'     => false,
				'turn_back'     => $turn_back,
				'user_id'       => $user_id,
				'amount'        => $pay_price,
				'final_fn'      => ['/lib/app/plugin/activate', 'after_pay'],
				'final_fn_args' => $temp_args,
			];



			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				$result['pay_link'] = $result_pay['url'];
			}
			else
			{
				\dash\log::oops('generate_pay_plugin_error', T_("Oh!, We cannot complete your request. Please contact to administrator"));
				return false;
			}

		}
		else
		{
			if(self::after_pay($temp_args))
			{
				$result['plugin_enabled'] = true;
				// ok need less to pay anything
			}
		}



		return $result;
	}


	public static function after_pay($_args)
	{
		var_dump(func_get_args());exit;
		if(isset($_args['plugin']) && is_array($_args['plugin']))
		{
			// ok
		}
		else
		{
			\dash\log::oops('pluginIsNotArray');
			return false;
		}

		if(a($_args, 'user_id') && a($_args, 'business_id'))
		{
			// ok
		}
		else
		{
			\dash\log::oops('pluginUserIdOrBusinessIdNotSet');
			return false;
		}

		$user_id     = $_args['user_id'];
		$business_id = $_args['business_id'];
		$plugin  = $_args['plugin'];

		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);


		\dash\pdo::transaction();

		$is_activated_in_business = \lib\db\store_plugin\get::by_business_id_lock($business_id, $plugin);

		if(!is_array($is_activated_in_business))
		{
			$is_activated_in_business = [];
		}

		foreach ($is_activated_in_business as $business_plugin)
		{
			$saved_plugin = a($business_plugin, 'plugin');
			$saved_status = a($business_plugin, 'status');

			if(in_array($saved_plugin, $plugin))
			{
				if($saved_status === 'enable')
				{
					// the user pay this plugin before
				}
				else
				{
					$price  = floatval(\lib\app\plugin\get::price($saved_plugin));

					\dash\db::transaction();
					// check budget
					$user_budget = \dash\app\transaction\budget::get_and_lock($user_id);

					if($user_budget > $price)
					{
						$insert_transaction =
						[
							'user_id' => $user_id,
							'title'   => T_("Activate plugin :val", ['val' => \lib\app\plugin\get::title($saved_plugin)]),
							'amount'  => $price,
						];

						$transaction_id = \dash\app\transaction\budget::minus($insert_transaction);

						\lib\db\store_plugin\update::record(['status' => 'enable', 'datemodified' => date("Y-m-d H:i:s")], a($business_plugin, 'id'));


						// send notif to supervisor
						$log =
						[
							'my_plugin'         => $saved_plugin,
							'my_business_id'    => $business_id,
							'my_user_id'        => $user_id,
							'my_page_url'       => a($_args, 'page_url'),
							'my_business_title' => a($load_busness_detail, 'title'),
							'my_price'          => $price,

						];
						\dash\log::set('business_plugin', $log);

						\dash\db::commit();
					}
					else
					{
						\dash\db::rollback();
					}
				}
			}
		}

		\dash\pdo::commit();

		// send request to api.busisness.jibres to alert him the plugin is payed

		\lib\api\business\api::sync_required($business_id);

		return true;

	}


	/**
	 * Admin can add force one plugin to business
	 *
	 * @param      <type>  $_business_id  The business identifier
	 * @param      <type>  $_plugin       The plugin
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
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

			\dash\notif::ok(T_("Plugin exist. Re Enabled"));
		}
		else
		{
			$price  = floatval(\lib\app\plugin\get::price($plugin));

			$insert =
			[
				'store_id'    => $_business_id,
				'plugin'      => $plugin,
				'zone'        => \lib\app\plugin\get::zone($plugin),
				'status'      => 'enable',
				'addedby'     => 'admin',
				'user_id'     => \dash\user::id(),
				'price'       => $price,
				'finalprice'  => 0,
				'datecreated' => date("Y-m-d H:i:s"),
			];

			\lib\db\store_plugin\insert::new_record($insert);

			\dash\notif::ok(T_("Plugin added"));
		}



		// send request to api.busisness.jibres to alert him the plugin is payed

		\lib\api\business\api::sync_required($business_id);


		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_plugin_add_by_admin' => true,
			'my_plugin'              => $plugin,
			'my_business_id'         => $business_id,
			'my_user_id'             => \dash\user::id(),
			'my_business_title'      => a($load_busness_detail, 'title'),

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
				\dash\notif::ok(T_("Plugin removed"));
			}
			else
			{
				\dash\notif::warn(T_("Plugin already removed"));
				return false;
			}


		}
		else
		{
			\dash\notif::error(T_("Plugin not exist"));
			return false;
		}



		// send request to api.busisness.jibres to alert him the plugin is payed

		\lib\api\business\api::sync_required($business_id);

		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_plugin_removed' => true,
			'my_plugin'     => $plugin,
			'my_business_id'     => $business_id,
			'my_user_id'         => \dash\user::id(),
			'my_business_title'  => a($load_busness_detail, 'title'),

		];

		\dash\log::set('business_plugin', $log);


	}
}
?>
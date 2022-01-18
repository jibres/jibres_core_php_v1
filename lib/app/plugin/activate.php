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


		// --------------- Load price
		$price = \lib\app\plugin\get::price($plugin, $data['periodic']);

		if(!is_numeric($price))
		{
			\dash\notif::error(T_("Invalid periodic key!"));
			return false;
		}

		$price = floatval($price);



		$user_id = \dash\user::id();

		\dash\pdo::transaction();

		$exist_plugin_record = \lib\db\store_plugin\get::by_business_id_lock($_business_id, $plugin);

		if(!is_array($exist_plugin_record))
		{
			$exist_plugin_record = [];
		}

		// plugin id
		$plugin_id = null;
		// action id
		$action_id = null;

		if(isset($exist_plugin_record['id']))
		{
			// set plugin id
			$plugin_id = $exist_plugin_record['id'];
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
				\dash\log::oops('ErrorInAddNewPlugin', T_(__LINE__. "Can not add this plugin. Please contact to administrator"));
				return false;
			}
		}

		$action_description = null;
		if($data['use_budget'])
		{
			$action_description = 'Use budget to pay price';
		}


		// check if plugin type is once and activated before
		// if pending needless to check on this function. Check in after_pay()
		$insert_action =
		[
			'plugin_id'   => $plugin_id,
			'action'      => 'request_activate',
			'addedby'     => 'user',
			'type'        => 'activate',
			'user_id'     => $user_id,
			'price'       => $price,
			'finalprice'  => $price,
			'status'      => 'enable',
			'desc'        => $action_description,
			'datecreated' => date("Y-m-d H:i:s"),

		];

		if($plugin_type === 'once')
		{
			if(a($exist_plugin_record, 'status') === 'enable')
			{
				\dash\pdo::rollback();
				\dash\notif::ok(T_("This plugin is already activated for your business"));
				return true;
			}
		}
		else
		{
			$plus_day  = \lib\app\plugin\get::plus_day($plugin, $data['periodic']);


			list($datestart, $action_description) = self::detect_plugin_date_start($plugin_id, $exist_plugin_record);

			$new_date_expire = date("Y-m-d H:i:s", $datestart + \lib\app\plugin\get::day_to_time($plus_day));

			if(a($plugin_detail, 'max_period'))
			{
				if(strtotime($new_date_expire) > (strtotime($plugin_detail['max_period'])))
				{
					\dash\pdo::rollback();
					\dash\notif::error(T_("Can not active this plugin more than this time!"));
					return false;
				}
			}
		}



		$action_id = \lib\db\store_plugin_action\insert::new_record($insert_action);

		if(!$action_id)
		{
			\dash\pdo::rollback();
			\dash\log::oops('ErrorInAddNewPluginAction', T_(__LINE__. "Can not add this action. Please contact to administrator"));
			return false;
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
		$temp_args['business_id'] = $_business_id;
		$temp_args['plugin']      = $plugin;
		$temp_args['plugin_id']   = $plugin_id;
		$temp_args['action_id']   = $action_id;
		$temp_args['periodic']    = $data['periodic'];
		$temp_args['user_id']     = $user_id;

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
				// save transaction id in action
				\lib\db\store_plugin_action\update::record(['transaction_id' => \dash\coding::decode($result_pay['transaction_id'])], $action_id);

				$result['pay_link'] = $result_pay['url'];
			}
			else
			{
				\dash\pdo::rollback();
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
			else
			{
				\dash\pdo::rollback();
				\dash\log::oops('pluginAfterPayError', T_("Oh!, We cannot complete your request. Please contact to administrator"));
				return false;
			}
		}

		return $result;
	}



	/**
	 * After pay
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function after_pay($_args)
	{

		if(isset($_args['plugin']) && is_string($_args['plugin']))
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
		$plugin      = $_args['plugin'];
		$plugin_id   = $_args['plugin_id'];
		$action_id   = $_args['action_id'];

		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);

		\dash\pdo::transaction();

		// load plugin detail
		$exist_plugin_record = \lib\db\store_plugin\get::by_business_id_plugin_id_lock($business_id, $plugin_id, $plugin);

		if(!is_array($exist_plugin_record))
		{
			$exist_plugin_record = [];
		}

		if(!$exist_plugin_record)
		{
			\dash\pdo::rollback();
			\dash\log::oops('pluginCanNotFindActivateRequest', T_("Can not find your activate plugin request. Please contact to administrator"));
			return false;
		}

		// load action details
		$load_action_detail = \lib\db\store_plugin_action\get::by_id($action_id);

		if(!$load_action_detail || !is_array($load_action_detail))
		{
			\dash\pdo::rollback();
			\dash\log::oops('pluginCanNotFindActionRecord', T_("Can not find your activate action. Please contact to administrator"));
			return false;
		}

		// load plugin detail
		$plugin_detail = \lib\app\plugin\get::detail($plugin);

		if(!$plugin_detail || !is_array($plugin_detail))
		{
			\dash\pdo::rollback();
			\dash\log::oops('pluginAfterPayNotLoaded', T_("Plugin not found. Please contact to administrator"));
			return false;
		}


		$plugin_type = a($plugin_detail, 'type');

		if(a($exist_plugin_record, 'status') === 'enable')
		{
			if($plugin_type === 'once')
			{
				\dash\pdo::rollback();
				// the user pay this plugin before
				\dash\notif::ok(T_("This plugin is already activated for your business"));
				return true;
			}
			else
			{
				// check max time
			}
		}

		$periodic = a($_args, 'periodic');

		// --------------- Get price
		$price  = \lib\app\plugin\get::price($plugin, $periodic);

		if(!is_numeric($price))
		{
			\dash\pdo::rollback();
			\dash\notif::error(T_("Invalid periodic key!"));
			return false;
		}

		$price = floatval($price);


		// --------------- Get plus day
		$plus_day = null;

		if($plugin_type === 'periodic')
		{
			$plus_day  = \lib\app\plugin\get::plus_day($plugin, $periodic);
		}


		// update plugin
		$update_plugin =
		[
			'status'       => 'enable',
			'datemodified' => date("Y-m-d H:i:s"),
		];


		// check budget
		$user_budget = \dash\app\transaction\budget::get_and_lock($user_id);

		if($user_budget < $price)
		{
			\dash\pdo::rollback();
			\dash\notif::ok(T_("This plugin is already activated for your business"));
			return true;
		}


		$transaction_id = null;

		if($price)
		{

			$insert_transaction =
			[
				'user_id' => $user_id,
				'title'   => T_("Activate plugin :val", ['val' => \lib\app\plugin\get::title($plugin)]),
				'amount'  => $price,
			];

			$transaction_id = \dash\app\transaction\budget::minus($insert_transaction);

			if(!$transaction_id || !is_numeric($transaction_id))
			{
				\dash\pdo::rollback();
				\dash\log::oops('PluginAfterPayCanNotAddMinusTransaction', T_(__LINE__. "Can not add this action. Please contact to administrator"));
				return false;
			}
		}

		// check if plugin type is once and activated before
		// if pending needless to check on this function. Check in after_pay()
		$insert_action =
		[
			'plugin_id'      => $plugin_id,
			'action'         => 'activate_complete',
			'addedby'        => 'user',
			'type'           => 'activate',
			'user_id'        => $user_id,
			'parent'         => $action_id,
			'transaction_id' => $transaction_id,
			'price'          => $price,
			'finalprice'     => $price,
			'status'         => 'enable',
			'datecreated'    => date("Y-m-d H:i:s"),
		];


		if($plus_day)
		{
			// calculate start date and end date and fill the $insert_action
			$action_description = null;


			list($datestart, $action_description) = self::detect_plugin_date_start($plugin_id, $exist_plugin_record);

			$plus_day  = \lib\app\plugin\get::plus_day($plugin, $periodic);


			$insert_action['datestart']  = date("Y-m-d H:i:s", $datestart);
			$insert_action['plusday']    = $plus_day;
			$insert_action['expiredate'] = date("Y-m-d H:i:s", $datestart + \lib\app\plugin\get::day_to_time($plus_day));
			$insert_action['desc']       = $action_description;

			if(a($plugin_detail, 'max_period'))
			{
				if(strtotime($insert_action['expiredate']) > (strtotime($plugin_detail['max_period'])))
				{
					\dash\pdo::rollback();
					\dash\notif::error(T_("Can not active this plugin more than this time!"));
					return false;
				}
			}

			$update_plugin['expiredate'] = $insert_action['expiredate'];
		}

		// enable plugin
		\lib\db\store_plugin\update::record($update_plugin, a($exist_plugin_record, 'id'));

		$action_id = \lib\db\store_plugin_action\insert::new_record($insert_action);

		if(!$action_id)
		{
			\dash\pdo::rollback();
			\dash\log::oops('ErrorInAddNewPluginAction', T_(__LINE__. "Can not add this action. Please contact to administrator"));
			return false;
		}

		\dash\pdo::commit();
		// send notif to supervisor
		$log =
		[
			'my_plugin'         => $plugin,
			'my_business_id'    => $business_id,
			'my_user_id'        => $user_id,
			'my_page_url'       => a($_args, 'page_url'),
			'my_business_title' => a($load_busness_detail, 'title'),
			'my_price'          => $price,
		];
		\dash\log::set('business_plugin', $log);


		// send request to api.busisness.jibres to alert him the plugin is payed

		\lib\api\business\api::sync_required($business_id);

		return true;

	}


	/**
	 * Detect max expire date and return the new start date
	 *
	 * @param      <type>  $_plugin_id  The plugin identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function detect_plugin_date_start($_plugin_id, $_exist_plugin_record) : array
	{
		$action_description = null;
		$datestart          = null;

		$get_max_expiredate = \lib\db\store_plugin_action\get::max_expire_date($_plugin_id);

		if(!$get_max_expiredate || !is_string($get_max_expiredate) || strtotime($get_max_expiredate) === false)
		{
			$action_description = 'Max expiredate not found or is not valid datetime';
			$datestart = time();
		}
		elseif(a($_exist_plugin_record, 'status') !== 'enable')
		{
			$action_description = 'Master plugin record is not enable! start date set on today';
			$datestart = time();
		}
		else
		{
			$get_max_expiredate_time = strtotime($get_max_expiredate);
			if($get_max_expiredate_time >= time())
			{
				$action_description = 'Start date set after last expire date';
				$datestart = $get_max_expiredate_time;
			}
			else
			{
				$action_description = 'The start date was set today because the last expiration date has passed';
				$datestart = time();
			}
		}

		return [$datestart, $action_description];

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

				// update all activated history status
				\lib\db\store_plugin_action\update::set_status_by_plugin_id('deleted', $check['id']);

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



	public static function admin_edit($_args, $_plugin_id)
	{

		$plugin_id = \dash\validate::id($_plugin_id);


		if(!$plugin_id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		$check = \lib\db\store_plugin\get::by_id($plugin_id);

		if(isset($check['id']))
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Plugin not exist"));
			return false;
		}

		$condition =
		[
			'status'      => ['enum' => ['enable', 'deleted']],
			'expiredate'    => 'date',

		];

		$require = ['status'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		\lib\db\store_plugin\update::record($data, $plugin_id);

		\lib\db\store_plugin_action\update::set_status_by_plugin_id('deleted', $check['id']);

		$insert_action =
		[
			'plugin_id'      => $plugin_id,
			'action'         => 'admin_edit',
			'addedby'        => 'admin',
			// 'type'           => 'edit',
			'user_id'        => \dash\user::id(),
			'status'         => 'enable',
			'datecreated'    => date("Y-m-d H:i:s"),
		];

		$action_id = \lib\db\store_plugin_action\insert::new_record($insert_action);


		// send request to api.busisness.jibres to alert him the plugin is payed

		\lib\api\business\api::sync_required($check['store_id']);

		\dash\notif::ok(T_("Sync request sended to business"));



		// // send notif to supervisor
		// $load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		// $log =
		// [
		// 	'my_plugin_removed' => true,
		// 	'my_plugin'     => $plugin,
		// 	'my_business_id'     => $business_id,
		// 	'my_user_id'         => \dash\user::id(),
		// 	'my_business_title'  => a($load_busness_detail, 'title'),

		// ];

		// \dash\log::set('business_plugin', $log);


	}

}
?>
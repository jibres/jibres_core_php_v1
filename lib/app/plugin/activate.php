<?php
namespace lib\app\plugin;

/**
 * This class describes a pay.
 * This class call from api
 */
class activate
{
	public static function activate($_business_id, $_plugin, $_args = [])
	{
		if(!is_array($_plugin))
		{
			\dash\notif::error(T_("Invalid plugin args"));
			return false;
		}

		$plugin = array_filter($_plugin);
		$plugin = array_unique($plugin);

		if(!$plugin)
		{
			\dash\notif::error(T_("No plugin to pay!"));
			return false;
		}

		if(count($plugin) > 100)
		{
			\dash\notif::error(T_("Too meany plugin!"));
			return false;
		}

		$user_id = \dash\user::id();

		\dash\pdo::transaction();

		$business_plugin_list = \lib\db\store_plugin\get::by_business_id_lock($_business_id);

		if(!is_array($business_plugin_list))
		{
			$business_plugin_list = [];
		}

		$calculate_price = [];
		$price           = 0;

		foreach ($business_plugin_list as $business_plugin)
		{
			$saved_plugin = a($business_plugin, 'plugin');
			$saved_status     = a($business_plugin, 'status');

			if(in_array($saved_plugin, $plugin))
			{
				unset($plugin[array_search($saved_plugin, $plugin)]);

				if($saved_status === 'enable')
				{
					// the user pay this plugin before
				}
				elseif($saved_status === 'pending')
				{
					// nothing
					$calculate_price[] = $saved_plugin;
				}
				else
				{
					// set pending
					$updated = \lib\db\store_plugin\update::record(['status' => 'pending', 'datemodified' => date("Y-m-d H:i:s")], a($business_plugin, 'id'));
					if(!$updated)
					{
						\dash\log::oops('ErrorInUpdatePlugin', T_("Can not edit this plugin. Please contact to administrator"));
						\dash\pdo::rollback();
						return false;
					}

					$calculate_price[] = $saved_plugin;
				}
			}
		}


		// have new plugin
		if($plugin)
		{
			foreach ($plugin as $key => $plugin)
			{
				$price  = floatval(get::price($plugin));

				$insert =
				[
					'store_id'    => $_business_id,
					'plugin'      => $plugin,
					'zone'        => get::zone($plugin),
					'status'      => 'pending',
					'addedby'     => 'user',
					'user_id'     => $user_id,
					'price'       => $price,
					'finalprice'  => $price,
					'datecreated' => date("Y-m-d H:i:s"),
				];

				$id = \lib\db\store_plugin\insert::new_record($insert);
				if(!$id)
				{
					\dash\log::oops('ErrorInAddNewPlugin', T_("Can not add this plugin. Please contact to administrator"));
					\dash\pdo::rollback();
					return false;
				}

			}
		}

		\dash\pdo::commit();

		$pay_price       = 0;
		$calculate_price = array_merge($calculate_price, $plugin);
		$calculate_price = array_filter($calculate_price);
		$calculate_price = array_unique($calculate_price);

		if($calculate_price)
		{
			foreach ($calculate_price as $key => $plugin)
			{
				$price  = floatval(get::price($plugin));

				$pay_price += $price;
			}
		}


		// 		$user_budget = \dash\user::budget();
		// var_dump($_args, $pay_price, $user_budget);exit;
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
		$temp_args['plugin']    = $calculate_price;
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
				'msg_go'        => T_("Unlock Jibres plugin"),
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
				\dash\log::oops('generate_pay_error');
				return false;
			}

		}
		else
		{
			self::after_pay($temp_args);

			$result['plugin_enabled'] = true;
			// ok need less to pay anything
		}



		return $result;
	}


	public static function after_pay($_args)
	{
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
		$plugin    = $_args['plugin'];

		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);


		\dash\pdo::transaction();

		$business_plugin_list = \lib\db\store_plugin\get::by_business_id_lock($business_id);

		if(!is_array($business_plugin_list))
		{
			$business_plugin_list = [];
		}

		foreach ($business_plugin_list as $business_plugin)
		{
			$saved_plugin = a($business_plugin, 'plugin');
			$saved_status      = a($business_plugin, 'status');

			if(in_array($saved_plugin, $plugin))
			{
				if($saved_status === 'enable')
				{
					// the user pay this plugin before
				}
				else
				{
					$price  = floatval(get::price($saved_plugin));

					\dash\db::transaction();
					// check budget
					$user_budget = \dash\app\transaction\budget::get_and_lock($user_id);

					if($user_budget > $price)
					{
						$insert_transaction =
						[
							'user_id' => $user_id,
							'title'   => T_("Activate plugin :val", ['val' => get::title($saved_plugin)]),
							'amount'  => $price,
						];

						$transaction_id = \dash\app\transaction\budget::minus($insert_transaction);

						\lib\db\store_plugin\update::record(['status' => 'enable', 'datemodified' => date("Y-m-d H:i:s")], a($business_plugin, 'id'));


						// send notif to supervisor
						$log =
						[
							'my_plugin'    => $saved_plugin,
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

	}
}
?>
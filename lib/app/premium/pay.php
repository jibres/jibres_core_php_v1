<?php
namespace lib\app\premium;

/**
 * This class describes a pay.
 * This class call from api
 */
class pay
{
	public static function pay($_business_id, $_premium, $_args = [])
	{
		if(!is_array($_premium))
		{
			\dash\notif::error(T_("Invalid premium args"));
			return false;
		}


		$premium = array_filter($_premium);
		$premium = array_unique($premium);

		if(!$premium)
		{
			\dash\notif::error(T_("No premium to pay!"));
			return false;
		}

		if(count($premium) > 100)
		{
			\dash\notif::error(T_("Too meany premium!"));
			return false;
		}

		$user_id = \dash\user::id();

		\dash\pdo::transaction();

		$business_premium_list = \lib\db\store_premium\get::by_business_id_lock($_business_id);

		$calculate_price = [];
		$price           = 0;

		foreach ($business_premium_list as $business_premium)
		{
			$saved_premium_key = a($business_premium, 'premium_key');
			$saved_status = a($business_premium, 'status');

			if(in_array($saved_premium_key, $premium))
			{
				unset($premium[array_search($saved_premium_key, $premium)]);

				if($saved_status === 'enable')
				{
					// the user pay this premium before
				}
				elseif($saved_status === 'pending')
				{
					// nothing
					$calculate_price[] = $saved_premium_key;
				}
				else
				{
					// set pending
					\lib\db\store_premium\update::record(['status' => 'pending', 'datemodified' => date("Y-m-d H:i:s")], a($business_premium, 'id'));

					$calculate_price[] = $saved_premium_key;
				}
			}
		}


		// have new premium
		if($premium)
		{
			foreach ($premium as $key => $premium_key)
			{
				$price  = floatval(get::price($premium_key));

				$insert =
				[
					'store_id'    => $_business_id,
					'premium_key' => $premium_key,
					'zone'        => get::zone($premium_key),
					'status'      => 'pending',
					'addedby'     => 'user',
					'user_id'     => $user_id,
					'price'       => $price,
					'finalprice'  => $price,
					'datecreated' => date("Y-m-d H:i:s"),
				];

				\lib\db\store_premium\insert::new_record($insert);

			}
		}

		\dash\pdo::commit();

		$pay_price       = 0;
		$calculate_price = array_merge($calculate_price, $premium);
		$calculate_price = array_filter($calculate_price);
		$calculate_price = array_unique($calculate_price);

		if($calculate_price)
		{
			foreach ($calculate_price as $key => $premium_key)
			{
				$price  = floatval(get::price($premium_key));

				$pay_price += $price;
			}
		}


		// 		$user_budget = \dash\user::budget();
		// var_dump($_args, $pay_price, $user_budget);exit;
		if($pay_price)
		{
			// check use ad budget
			if(isset($_args['use_as_budget']) && $_args['use_as_budget'])
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
		$temp_args['premium']    = $calculate_price;
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
				'msg_go'        => T_("Unlock Jibres premium"),
				'auto_go'       => false,
				'auto_back'     => true,
				'final_msg'     => false,
				'turn_back'     => $turn_back,
				'user_id'       => $user_id,
				'amount'        => $pay_price,
				'final_fn'      => ['/lib/premium/pay', 'after_pay'],
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

			$result['premium_enabled'] = true;
			// ok need less to pay anything
		}



		return $result;
	}


	public static function after_pay($_args)
	{
		if(isset($_args['premium']) && is_array($_args['premium']))
		{
			// ok
		}
		else
		{
			\dash\log::oops('premiumIsNotArray');
			return false;
		}

		if(a($_args, 'user_id') && a($_args, 'business_id'))
		{
			// ok
		}
		else
		{
			\dash\log::oops('premiumUserIdOrBusinessIdNotSet');
			return false;
		}

		$user_id     = $_args['user_id'];
		$business_id = $_args['business_id'];
		$premium    = $_args['premium'];

		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);


		\dash\pdo::transaction();

		$business_premium_list = \lib\db\store_premium\get::by_business_id_lock($business_id);

		foreach ($business_premium_list as $business_premium)
		{
			$saved_premium_key = a($business_premium, 'premium_key');
			$saved_status      = a($business_premium, 'status');

			if(in_array($saved_premium_key, $premium))
			{
				if($saved_status === 'enable')
				{
					// the user pay this premium before
				}
				else
				{
					$price  = floatval(get::price($saved_premium_key));

					\dash\db::transaction();
					// check budget
					$user_budget = \dash\app\transaction\budget::get_and_lock($user_id);

					if($user_budget > $price)
					{
						$insert_transaction =
						[
							'user_id' => $user_id,
							'title'   => T_("Unlock premium :val", ['val' => get::title($saved_premium_key)]),
							'amount'  => $price,
						];

						$transaction_id = \dash\app\transaction\budget::minus($insert_transaction);

						\lib\db\store_premium\update::record(['status' => 'enable', 'datemodified' => date("Y-m-d H:i:s")], a($business_premium, 'id'));


						// send notif to supervisor
						$log =
						[
							'my_premium_key'    => $saved_premium_key,
							'my_business_id'    => $business_id,
							'my_user_id'        => $user_id,
							'my_page_url'       => a($_args, 'page_url'),
							'my_business_title' => a($load_busness_detail, 'title'),
							'my_price'          => $price,

						];
						\dash\log::set('business_premium', $log);

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

		// send request to api.busisness.jibres to alert him the premium is payed

		\lib\jpi\bpi::sync_required($business_id);

	}
}
?>
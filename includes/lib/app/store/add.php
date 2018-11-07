<?php
namespace lib\app\store;


trait add
{

	private static function check_promo($_price)
	{
		// $promo = \dash\app::request('promo');
		// if($promo === 'JibresTestStandard')
		// {
		// 	if(intval($_price) === 500000)
		// 	{
		// 		return true;
		// 	}
		// }

		// if($promo === 'JibresTestSimple')
		// {
		// 	if(intval($_price) === 100000)
		// 	{
		// 		return true;
		// 	}
		// }

		return false;

	}


	public static function before_add($_args)
	{
		\dash\app::variable($_args);

		$bank   = \dash\app::request('bank');
		$plan   = \dash\app::request('plan');
		$period = \dash\app::request('period');

		if(!in_array($plan, ['standard', 'simple', 'free']))
		{
			\dash\notif::error(T_("Invalid plan"), 'plan');
			return false;
		}

		if($plan === 'free' || $period === 'trial')
		{
			// create new store by free plan
			// just check count of free plan store
			// check store count
			$count_store_free = \lib\db\stores::get_count(['creator' => \dash\user::id(), 'plan' => ["IN", "('free', 'trial')"]]);

			if($count_store_free >= 2)
			{
				$msg = T_("You can not have more than two free or trial stores.");

				if(\dash\url::isLocal())
				{
					\dash\notif::warn($msg. "\n". T_("This msg in local is warn and in site is error :)"));
				}
				else
				{
					\dash\notif::error($msg);
					return false;
				}
			}

			if($period === 'trial')
			{
				$_args['startplan']  = date("Y-m-d H:i:s");
				$_args['expireplan'] = date("Y-m-d H:i:s", strtotime("+14 days"));
				$_args['plan']       = 'trial';
			}

			return self::add($_args);
		}

		if(!$plan)
		{
			\dash\notif::error(T_("Please select one of plan"), 'plan');
			return false;
		}

		if(!$period)
		{
			\dash\notif::error(T_("Please select one of period"), 'period');
			return false;
		}

		if(!in_array($period, ['1m', '12m']))
		{
			\dash\notif::error(T_("Invalid period"), 'period');
			return false;
		}

		$check = self::add($_args, true);
		if(!$check)
		{
			return false;
		}

		if(!$bank)
		{
			\dash\notif::error(T_("Please select one of payment to pay"), 'bank');
			return false;
		}

		$allow_bank = ['irkish', 'parsian', 'zarinpal'];

		if(\dash\url::isLocal())
		{
			array_push($allow_bank, 'payir');
		}

		if(!in_array($bank, $allow_bank))
		{
			\dash\notif::error(T_("Invalid payment"), 'bank');
			return false;
		}

		if($period === '1m')
		{
			$pay_key_period = 'monthly';
		}
		else
		{
			$pay_key_period = 'yearly';
		}

		$price = \lib\permission::plan_setting($pay_key_period, $plan);

		if(!is_numeric($price) || intval($price) <= 0)
		{
			// NEVER SHOW THIS SHOW
			\dash\log::set('storeHavePlanAndPriceIS0');
			$_args['startplan']  = date("Y-m-d H:i:s");
			$_args['expireplan'] = date("Y-m-d H:i:s", strtotime("+14 days"));
			$_args['plan']       = 'trial';
			return self::add($_args);
		}

		$key = 'beforeAddStore_'. $plan. '_'. $period;

		\dash\session::set($key, $check);

		// check store count
		$user_budget = \dash\db\transactions::budget(\dash\user::id(), ['unit' => 'toman']);
		// if(is_array($user_budget))
		// {
		// 	$user_budget = array_sum($user_budget);
		// }

		$user_budget = floatval($user_budget);

		if(self::check_promo($price))
		{
			\dash\log::set('usePromoToAddStore');
			// set similar pay
			\dash\session::set('payment_verify_amount', $price);
			\dash\session::set('payment_verify_status', 'ok');
			\dash\session::set('payment_request_start', true);
			self::after_pay();
		}
		elseif($user_budget >= $price)
		{
			// set similar pay
			\dash\session::set('payment_verify_amount', $price);
			\dash\session::set('payment_verify_status', 'ok');
			\dash\session::set('payment_request_start', true);
			self::after_pay();
		}
		else
		{
			$meta = ['turn_back' => \dash\url::pwd()];

			\dash\utility\payment\pay::start(\dash\user::id(), $bank, $price, $meta);
		}
	}


	public static function after_pay()
	{
		$status      = \dash\session::get('payment_verify_status');
		$price_payed = \dash\session::get('payment_verify_amount');

		\dash\session::set('payment_verify_amount', null);
		\dash\session::set('payment_verify_status', null);
		\dash\session::set('payment_request_start', null);

		if($status !== 'ok')
		{
			\dash\notif::error(T_("Transaction unsuccessful. Store registration operation canceled"));
			return false;
		}

		\dash\notif::ok(T_("Transaction successful."));

		$price_payed = intval($price_payed);

		if(!$price_payed || $price_payed < 0)
		{
			\dash\notif::error(T_("The amount entered is incorrect"));
			return false;
		}

		$plan_price =
		[
			'simple_1m'    => \lib\permission::plan_setting('monthly', 'simple'),
			'simple_12m'   => \lib\permission::plan_setting('yearly', 'simple'),

			'standard_1m'  => \lib\permission::plan_setting('monthly', 'standard'),
			'standard_12m' => \lib\permission::plan_setting('yearly', 'standard'),
		];

		$plan_price = array_flip($plan_price);

		if(!isset($plan_price[$price_payed]))
		{
			\dash\notif::error(T_("The amount charged is inconsistent with the payment structure"));
			return false;
		}

		$key = 'beforeAddStore_'. $plan_price[$price_payed];

		$store = \dash\session::get($key);

		if(!$store)
		{
			\dash\notif::error(T_("Your store information was not found. Please try again"));
			return false;
		}

		$plan   = null;
		$period = null;
		$split  = explode('_', $key);

		if(isset($split[1]))
		{
			$plan = $split[1];
		}

		if(isset($split[2]))
		{
			$period = $split[2];
		}

		$day = $period === '12m' ? 365 : 30;

		$_args['startplan']  = date("Y-m-d H:i:s");
		$_args['expireplan'] = date("Y-m-d H:i:s", strtotime("+$day days"));
		$_args['plan']       = $plan;

		$insert = self::add($store);

		if(isset($insert['slug']))
		{
			// save factor
			// minus the value from user account
			// the user use largen than one month of the plan

			$invoice_title        = T_("Create store :name - plan :plan - period  :period ", ['plan' => $plan, 'period' => $period, 'name' => $insert['name']]);
			$invoice_detail_title = T_("Create store :name", ['name' => $insert['name']]);
			$transaction_title    = T_("Create store :name", ['name' => $insert['name']]);

		    $new_invoice =
			[
				'date'         => date("Y-m-d H:i:s"),
				'user_id'      => \dash\user::id(),
				'title'        => $invoice_title,
				'total'        => $price_payed,
				'count_detail' => 1,
			];

			$invoice = new \dash\db\invoices;
	        $invoice->add($new_invoice);

			$new_invoice_detail =
			[
				'title'      => $invoice_detail_title,
				'price'      => $price_payed,
				'count'      => 1,
				'total'      => $price_payed,
			];

	        $invoice->add_child($new_invoice_detail);

	        $invoice_id = $invoice->save();

			$transaction_set =
	        [
				'caller'         => 'invoicestore',
				'title'          => $transaction_title,
				'user_id'        => \dash\user::id(),
				'invoice_id'     => $invoice_id,
				'minus'          => $price_payed,
				'payment'        => null,
				'verify'         => 1,
				'dateverify'     => time(),
				'type'           => 'money',
				'unit'           => 'toman',
				'date'           => date("Y-m-d H:i:s"),
	        ];

	        \dash\db\transactions::set($transaction_set);

	        $store_id = $insert['store_id'];
	        $store_id = \dash\coding::decode($store_id);

	        $day = 0;

	        if($period == '1m')
	        {
	        	$day = 31;
	        }
	        elseif($period == '12m')
	        {
	        	$day = 365;
	        }

	        $update =
	        [
				'plan'       => $plan,
				'startplan'  => date("Y-m-d H:i:s"),
				'expireplan' => date("Y-m-d H:i:s", strtotime("+$day days")),
	        ];

	        \lib\db\stores::update($update, $store_id);

	        // if jibres in cloudflare we can not see the site for afew minutes
	        // so redirect to list of store
			// $new_url = \dash\url::protocol(). '://'. $insert['slug']. '.'. \dash\url::domain();
			// to show list of store
			$new_url = \dash\url::here(). '/store';

			\dash\redirect::to($new_url);
		}
		else
		{
			return false;
		}
	}
	/**
	 * add new store
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args = [], $_just_check = false)
	{
		\dash\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}
		// check store count
		$count_store = self::count_store_by_creator(\dash\user::id());

		if(\dash\url::isLocal())
		{
			// no check in local
		}
		else
		{
			if($count_store >= 1)
			{
				$user_budget = \dash\db\transactions::budget(\dash\user::id(), ['unit' => 'toman']);
				// if(is_array($user_budget))
				// {
				// 	$user_budget = array_sum($user_budget);
				// }
				$user_budget = floatval($user_budget);

				if($user_budget < 10000)
				{
					\dash\notif::error(T_("To register a second store, you need to have at least 10,000 toman in inventory on your account"));
					return false;
				}
			}

			if($count_store >= 3)
			{
				\dash\notif::error(T_("You can not have more than three active stores. Contact support if needed"));
				return false;
			}
		}

		if($_just_check)
		{
			return $args;
		}

		$return = [];

		\dash\temp::set('last_store_added', isset($args['slug'])? $args['slug'] : null);

		if(!isset($args['plan']))
		{
			\dash\notif::error(T_("Please choose plan of store"), 'plan');
			return false;
		}

		if(isset($_args['startplan']))
		{
			$args['startplan'] = $_args['startplan'];
		}

		if(isset($_args['expireplan']))
		{
			$args['expireplan'] = $_args['expireplan'];
		}

		$args['creator'] = \dash\user::id();
		$args['status']  = 'enable';

		$store_id = \lib\db\stores::insert($args);

		if(!$store_id)
		{
			$args['slug'] = self::slug_fix($args);
			$store_id     = \lib\db\stores::insert($args);
		}

		if(!$store_id)
		{
			\dash\notif::error(T_("No way to insert store"), 'db', 'system');
			return false;
		}

		// add planhistory
		$insert_planhistory =
		[
			'store_id' => $store_id,
			'plan'     => $args['plan'],
			'start'    => date("Y-m-d H:i:s"),
			'end'      => null,
			'creator'  => \dash\user::id(),
			'status'   => 'enable',
		];

		\lib\db\planhistory::insert($insert_planhistory);


		$insert_userstore =
		[
			'mobile'     => \dash\user::detail('mobile'),
			'firstname'  => \dash\user::detail('displayname') ?  \dash\user::detail('displayname') : T_("You"),
			'staff'      => 1,
			'type'       => 'staff',
			'gender'     => \dash\user::detail('gender'),
			'postion'    => T_('Admin'),
			'permission' => 'admin',
		];

		\lib\app\thirdparty::add($insert_userstore, ['debug' => false, 'store_id' => $store_id]);


		if(\dash\url::isLocal())
		{
			// in local mode not set the subdomain
		}
		else
		{
			\dash\utility\cloudflare::create_dns_record(['type' => 'CNAME', 'name' => $args['slug'], 'content' => 'jibres.com']);
		}

		$return['store_id'] = \dash\coding::encode($store_id);
		$return['slug']     = $args['slug'];
		$return['name']     = $args['name'];

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Store successfuly added"));
		}

		return $return;
	}


	/**
	 * fix duplicate slug
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function slug_fix($_args)
	{
		if(!isset($_args['slug']))
		{
			$_args['slug'] = (string) \dash\user::id(). (string) rand(1000,5000);
		}

		$new_slug     = null;
		$similar_slug = \lib\db\stores::get_similar_slug($_args['slug']);
		$count        = count($similar_slug);
		$i            = 1;
		$new_slug     = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		while (in_array($new_slug, $similar_slug))
		{
			$i++;
			$new_slug = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		}

		\dash\temp::set('last_store_added', $new_slug);
		return $new_slug;
	}
}
?>
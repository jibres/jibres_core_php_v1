<?php
namespace lib\app\store;


class plan
{
	public static $plan       = [];

	private static $load_plan = false;


	private static function load()
	{
		if(!self::$load_plan)
		{
			$plan_file = root.'/includes/permission/plan.php';

			if(is_file($plan_file))
			{
				include_once($plan_file);
			}

			self::$load_plan = true;
		}
	}


	public static function set($_plan, $_meta = [])
	{
		\dash\permission::access('settingEditPlan');

		$default =
		[
			'period'       => null,
			'continuation' => null,
		];

		if(!is_array($_meta))
		{
			$_meta = [];
		}

		$_meta = array_merge($default, $_meta);

		extract($_meta);

		self::load();

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!array_key_exists($_plan, self::$plan))
		{
			\dash\notif::error(T_("Invalid plan"));
			return false;
		}

		$current_plan = \lib\store::detail('plan');

		if($_plan === 'trial')
		{
			\dash\notif::error(T_("Can not choose trial"));
			return false;
		}

		if($current_plan === 'free' && $_plan === 'free')
		{
			\dash\notif::error(T_("Your plan is free, can not continuation it!"));
			return false;
		}

		if($_plan === $current_plan)
		{
			if(!$continuation)
			{
				\dash\notif::error(T_("This is your current plan"));
				return false;
			}
		}


		$price = 0;

		if($_plan !== 'free')
		{
			if(!$period)
			{
				\dash\notif::error(T_("Invalid period of plan"));
				return false;
			}

			if(!array_key_exists($period, self::$plan[$_plan]))
			{
				\dash\notif::error(T_("Invalid period of plan"));
				return false;
			}

			$price = self::$plan[$_plan][$period];
		}


		// check store count
		$user_budget = \dash\db\transactions::budget(\dash\user::id(), ['unit' => 'toman']);

		$user_budget = floatval($user_budget);

		$final_fn_args =
		[
			'plan'     => $_plan,
			'expire'   => date("Y-m-d H:i:s", strtotime("+19 days")),
			'store_id' => \lib\store::id(),
			'user_id'  => \dash\user::id(),
			'price'    => $price,
		];

		if($user_budget >= $price)
		{
			self::after_pay($final_fn_args);
		}
		else
		{

			$meta =
			[
				'msg_go'        => null,
				'turn_back'     => \dash\url::kingdom(). '/a/setting/plan',
				'user_id'       => \dash\user::id(),
				'amount'        => $price,
				'final_fn'      => ['/lib/app/store/plan', 'after_pay'],
				'final_fn_args' => $final_fn_args,
			];

			\dash\utility\pay\start::site($meta);

		}
	}


	public static function after_pay($_args)
	{
		extract($_args);

		// save factor
		// minus the value from user account
		// the user use largen than one month of the plan

		$invoice_title        = T_("Change store plan to :plan", ['plan' => $plan]);
		$invoice_detail_title = $invoice_title;
		$transaction_title    = $invoice_title;

	    $new_invoice =
		[
			'date'         => date("Y-m-d H:i:s"),
			'user_id'      => $user_id,
			'title'        => $invoice_title,
			'total'        => $price,
			'count_detail' => 1,
		];

		$invoice = new \dash\db\invoices;
        $invoice->add($new_invoice);

		$new_invoice_detail =
		[
			'title'      => $invoice_detail_title,
			'price'      => $price,
			'count'      => 1,
			'total'      => $price,
		];

        $invoice->add_child($new_invoice_detail);

        $invoice_id = $invoice->save();

		$transaction_set =
        [
			'caller'         => 'invoicestore',
			'title'          => $transaction_title,
			'user_id'        => $user_id,
			'invoice_id'     => $invoice_id,
			'minus'          => $price,
			'payment'        => null,
			'verify'         => 1,
			'dateverify'     => time(),
			'type'           => 'money',
			'unit'           => 'toman',
			'date'           => date("Y-m-d H:i:s"),
        ];

        \dash\db\transactions::set($transaction_set);

        $set =
		[
			'status' => 'disable',
			'end'    => date("Y-m-d H:i:s"),
		];

		$where =
		[
			'store_id' => $store_id,
			'status'   => 'enable',
			'end'      => null,
		];

		\lib\db\planhistory::update_where($set, $where);

		$set_new             = [];
		$set_new['store_id'] = $store_id;
		$set_new['plan']     = $plan;
		$set_new['creator']  = $user_id;
		$set_new['price']    = $price;
		$set_new['status']   = 'enable';
		$set_new['start']    = date("Y-m-d H:i:s");

		\lib\db\planhistory::insert($set_new);

        $update =
        [
			'plan'       => $plan,
			'startplan'  => date("Y-m-d H:i:s"),
			'expireplan' => $expire,
        ];

        \lib\db\stores::update($update, $store_id);

        \lib\store::refresh();

        \dash\notif::ok(T_("Your plan was changed"));
	}
}
?>
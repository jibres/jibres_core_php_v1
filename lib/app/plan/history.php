<?php
namespace lib\app\plan;



class history
{

	public static function set($_plan, $_store_id, $_detail)
	{
		$period = isset($_detail['key']) ? $_detail['key'] : null;

		switch ($period)
		{
			case '1month':
				$plus_time = strtotime("+1 month") - time();
				break;

			case '1year':
				$plus_time = strtotime("+1 year") - time();
				break;

			default:
				return false;
				break;
		}

		$get_last_plan = \lib\db\store_plan\get::last_plan_saved($_plan, $_store_id);

		if(isset($get_last_plan['id']))
		{
			var_dump($get_last_plan);exit();
		}

		$start      = date("Y-m-d H:i:s");
		$end        = date("Y-m-d H:i:s", strtotime("+1 month"));
		$expireplan = date("Y-m-d H:i:s", strtotime($start) + $_plan);

		$insert_new_plan =
		[
			'store_id'    => $_store_id,
			'plan'        => $_plan,
			'user_id'     => \dash\user::jibres_user(),
			'start'       => $start,
			'end'         => $end,
			'status'      => 'enable',
			'price'       => a($_detail, 'price'),
			'discount'    => null,
			'promo'       => null,
			'period'      => a($_detail, 'period'),
			'expireplan'  => $expireplan,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		var_dump($insert_new_plan);

		var_dump(func_get_args());exit();

		if(!isset($_args['plan']))
		{
			\dash\notif::error(T_("Please choose a plan"));
			return false;
		}

		$plan = $_args['plan'];
		$plan = \dash\validate::string_50($plan);
		if(!$plan)
		{
			\dash\notif::error(T_("Please choose a plan"));
			return false;
		}

		$choose_plan = [];

		$list = self::price_list();
		foreach ($list as $key => $value)
		{
			if(isset($value['key']) && $value['key'] === $plan)
			{
				$choose_plan = $value;
			}
		}

		if(!$choose_plan)
		{
			\dash\notif::error(T_("Invalid plan"));
			return false;
		}


		// start transaction
		// plus budget
		// minus budget
		// save plan history
		// reset business catch


		var_dump($_args);exit();
	}

}
?>
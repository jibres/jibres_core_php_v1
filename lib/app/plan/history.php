<?php
namespace lib\app\plan;



class history
{

	public static function set($_plan, $_store_id, $_detail)
	{
		$period = isset($_detail['key']) ? $_detail['key'] : null;

		$now   = time();
		$start = date("Y-m-d H:i:s");

		switch ($period)
		{
			case '1month':
				$plus_time = strtotime("+31 days") - $now;
				break;

			case '1year':
				$plus_time = strtotime("+1 year") - $now;

				break;

			default:
				return false;
				break;
		}

		$end        = date("Y-m-d H:i:s", $now + $plus_time);
		$expireplan = date("Y-m-d H:i:s", $now + $plus_time);

		$get_last_plan = \lib\db\store_plan\get::last_plan_saved($_plan, $_store_id);
		if(isset($get_last_plan['id']) && isset($get_last_plan['expireplan']) && isset($get_last_plan['end']))
		{
			$old_expireplan = $get_last_plan['expireplan'];
			$old_expireplan = strtotime($old_expireplan);

			$old_end = $get_last_plan['end'];
			$old_end = strtotime($old_end);

			if($old_end === false || $old_expireplan === false)
			{
				\dash\log::oops('invalidPlanDate');
				return false;
			}

			if($old_expireplan > $now)
			{
				$expireplan = date("Y-m-d H:i:s", $old_expireplan + $plus_time);
			}

			if($old_end > strtotime($start))
			{
				$start = date("Y-m-d H:i:s", $old_end);
				$end   = date("Y-m-d H:i:s", strtotime($start) + $plus_time);
			}
		}

		// check max plan time 1.5 year
		if((strtotime($expireplan) - time()) > (60*60*24*30*18)) // 18 month = 1.5 year
		{
			\dash\notif::error(T_("Can not register plan more than 1.5 year"));
			return false;
		}

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

		$insert_plan = \lib\db\store_plan\insert::new_record($insert_new_plan);

		if(!$insert_plan)
		{
			\dash\log::oops('canNotInsertPlan', T_("We can not add Save your plan history. Please contact to administrator"));
			return false;
		}

		switch ($_plan)
		{
			case 'branding':
				\lib\db\store\update::branding($expireplan, $_store_id);
				$load_store = \lib\db\store\get::by_id($_store_id);

				if(!isset($load_store['id']))
				{
					\dash\notif::error(T_("Store not found"));
					return false;
				}

				$my_store_db          = \dash\engine\store::make_database_name($load_store['id']);

				\lib\db\setting\update::overwirte_cat_key_fuel($expireplan, 'store_setting', 'branding', $load_store['fuel'], $my_store_db);

				\lib\store::reset_cache($load_store['id'], $load_store['subdomain']);
				break;

			default:
				\dash\notif::warn(T_("Not support!"));
				break;
		}

		return $insert_plan;
	}

}
?>
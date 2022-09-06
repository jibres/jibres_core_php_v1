<?php

namespace lib\app\plan;

class planChoose
{


	public static function choose(array $_args)
	{
		$data = self::cleanArgs($_args);

		$planActivateOnJibres = \lib\api\jibres\api::plan_activate($data);


		if (isset($planActivateOnJibres['result']['payLink']))
		{
			\dash\redirect::to($planActivateOnJibres['result']['payLink']);
		}
		elseif (isset($planActivateOnJibres['result']['planActivate']) && $planActivateOnJibres['result']['planActivate'])
		{
			\dash\redirect::pwd();
		}

	}


	private static function cleanArgs(array $_args)
	{
		$condition =
			[
				'plan'        => ['enum' => planList::list()],
				'period'      => ['enum' => ['monthly', 'yearly']],
				'action_type' => ['enum' => ['register', 'renew']],
				'use_budget'  => 'bit',
				'turn_back'   => 'string_2000',
			];

		$require = ['plan'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		return $data;
	}


	public static function allowChoosePlan(array $_currentPlan, plan $_newPlan, $_admin = false) : bool
	{
		$plan = $_currentPlan['plan'];

		if ($plan === $_newPlan->name() && $plan === 'free')
		{
			\dash\notif::error(T_("Your current plan by new plan is equal!"));
			return false;
		}

		if (!$_admin)
		{
			if (isset($_currentPlan['expirydate']) && $_currentPlan['expirydate'])
			{
				// show renew button if less than 14 days remain and in backend open at +15 days
				if (strtotime($_currentPlan['expirydate']) >= strtotime("+15 days"))
				{
					\dash\notif::error_once(T_("You can get a new plan only within 14 days before the plan expires"));
					return false;
				}
				else
				{
					return true;
				}
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}


	public static function allowChoosePlanAdmin(array $currentPlan, plan $newPlan)
	{
		return self::allowChoosePlan($currentPlan, $newPlan, true);
	}

}
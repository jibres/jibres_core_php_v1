<?php

namespace lib\app\plan;

class planFactor
{

	public static function calculate($_business_id, array $_args)
	{
		$data = self::cleanArgs($_args);

		if (!$data['plan'])
		{
			\dash\notif::error_once(T_("Plan arguments is required!"));
			return false;
		}

		if ($data['action_type'] === 'register')
		{
			return self::registerFactor($_business_id, $data);
		}
		elseif ($data['action_type'] === 'cancel')
		{
			return self::cancelFactor($_business_id, $data);
		}
		else
		{
			\dash\notif::error_once(T_("Invalid action type"));
			return false;
		}

	}


	private static function registerFactor($_business_id, array $data)
	{
		$result      = [];
		$factor      = [];
		$detail      = [];
		$access      = true;
		$reason      = null;
		$actionTitle = null;

		$currentPlans = storePlan::currentPlan($_business_id);

		if (a($currentPlans, 'plan') !== 'free')
		{
			if ($data['action_type'] === 'register')
			{
				$access = false;
				$reason = T_("You must cancel current plan to choose another");
			}
		}

		$loadPlan = planLoader::load($data['plan']);
		$loadPlan->setPeriod($data['period']);
		$loadPlan->prepare();

		$planTitle = $loadPlan->title();
		$price     = $loadPlan->price();

		if ($data['action_type'] === 'register')
		{
			$actionTitle = T_("Buy plan");
		}

		if ($data['period'] === 'monthly')
		{
			$detail[] = ['title' => T_("Period"), 'value' => T_("One month")];
		}
		else
		{
			$detail[] = ['title' => T_("Period"), 'value' => T_("One year")];
		}


		$result['factor'] = $factor;
		$result['total']  =
			[
				"price"    => $price,
				"currency" => 'IRT',
			];

		$result['access'] =
			[
				'ok'     => $access,
				'reason' => $reason,
				'type'   => 'error',
			];

		$result['user'] =
			[
				'budget' => \dash\db\transactions::budget(\dash\user::id()),
			];

		$result['detail'] = $detail;


		$result['meta'] =
			[
				'action_title' => $actionTitle,
				'plan_title'   => $planTitle,
			];

		return $result;
	}


	private static function cancelFactor($_business_id, array $data)
	{
		$result = [];
		$factor = [];
		$detail = [];
		$access = true;
		$reason = null;

		$currentPlan = storePlan::currentPlan($_business_id);

		if (a($currentPlan, 'plan') === 'free')
		{
			$access = false;
			$reason = T_("Can not cancel free plan!");
		}

		$price = $currentPlan['finalprice'];

		$factor[] = ['title' => T_("Your payment"), 'price' => $price];

		$actionTitle = T_("Cancel plan");

		$myPlan = $currentPlan['plan'];

		$myPlan    = planLoader::load($myPlan);
		$planTitle = $myPlan->title();

		planReady::calculateDays($currentPlan);

		$daysLeft  = floatval(a($currentPlan, 'daysLeft'));
		$daysSpent = floatval(a($currentPlan, 'daysSpent'));
		$days      = floatval(a($currentPlan, 'days'));
		if (!$days)
		{
			$days = 1;
		}


		if ($daysLeft)
		{
			$detail[] = ['title' => T_("Days left"), 'value' => \dash\fit::number($daysLeft)];
		}
		if ($daysSpent)
		{
			$detail[] = ['title' => T_("Days Spent"), 'value' => \dash\fit::number($daysSpent)];
		}

		$guaranteeDays = null;

		if (a($currentPlan, 'periodtype') === 'yearly')
		{

			$guaranteeDays = 30;
		}
		elseif (a($currentPlan, 'periodtype') === 'monthly')
		{
			$guaranteeDays = 7;
		}



		$useGuarantee = false;
		if ($guaranteeDays && $daysLeft)
		{
			if ($daysSpent <= $guaranteeDays)
			{
				if (!\lib\db\store_plan_history\get::user_before_from_guarantee($_business_id))
				{
					$useGuarantee = true;
				}
			}
		}


		if ($useGuarantee)
		{
			$factor[] = ['title' => T_("Guarantee refund"), 'price' => a($currentPlan, 'finalprice')];
			$detail[] = ['title' => T_("Guarantee"), 'value' => T_("Valid")];
		}
		else
		{
			// calculate spend days
			$pricePerDays = $price / $days;
			$priceSpent   = $pricePerDays * $daysSpent;
			// round 10000
			// 1633879.7814208
			// 1,633,879.7814208
			// 1,630,000

			$priceSpent = round($priceSpent, -3, PHP_ROUND_HALF_DOWN);

			$factor[] = ['title' => T_("Price spent"), 'price' => $priceSpent];

			$refund = $price - $priceSpent;

			$factor[] = ['title' => T_("Refund"), 'price' => $refund];

			$price = $refund;

		}

		if ($price < 0)
		{
			$price = 0;
		}

		$result['factor'] = $factor;

		$result['access'] =
			[
				'ok'     => $access,
				'reason' => $reason,
				'type'   => 'error',
			];


		$result['detail'] = $detail;
		$result['total']  =
			[
				"price"    => $price,
				"currency" => 'IRT',
			];

		$result['meta'] =
			[
				'action_title' => $actionTitle,
				'plan_title'   => $planTitle,
				'guarantee'    => $useGuarantee,
			];

		return $result;
	}


	private static function cleanArgs(array $_args)
	{
		$condition =
			[
				'plan'        => ['enum' => planList::list()],
				'period'      => ['enum' => ['monthly', 'yearly']],
				'action_type' => ['enum' => ['register', 'cancel']],
				'gift'        => 'string_100',
				'factor'      => 'bit', // just save for skipp input error
			];

		$require = ['plan'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}

}
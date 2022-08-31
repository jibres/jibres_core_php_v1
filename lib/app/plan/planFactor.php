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
		$result      = [];
		$factor      = [];
		$detail      = [];
		$access      = true;
		$reason      = null;

		$currentPlans = storePlan::currentPlan($_business_id);


		if (a($currentPlans, 'plan') === 'free')
		{
			$access = false;
			$reason = T_("Can not cancel free plan!");
		}

		$actionTitle = T_("Cancel plan");

		print_r($currentPlans);exit();

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
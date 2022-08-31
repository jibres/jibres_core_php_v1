<?php

namespace lib\app\plan;

class planFactor
{

	public static function calculate($_business_id, array $_args)
	{
		$result      = [];
		$factor      = [];
		$detail      = [];
		$access      = true;
		$reason      = null;
		$actionTitle = null;

		$data = self::cleanArgs($_args);

		$currentPlans = storePlan::currentPlan($_business_id);

		if(a($currentPlans, 'plan') !== 'free')
		{
			if($data['action_type'] === 'register')
			{
				$access = false;
				$reason = T_("You must cancel current plan to choose another");
			}
		}


		$loadPlan = planLoader::load($data['plan']);
		$loadPlan->setPeriod($data['period']);
		$loadPlan->prepare();

		$planTitle = $loadPlan->title();
		$price = $loadPlan->price();

		if($data['action_type'] === 'register')
		{
			$actionTitle = T_("Buy plan");
		}

		if($data['period'] === 'monthly')
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


	private static function  sampleResult()
	{
		$result           = [];
		$result['factor'] =
			[
				[
					'title'       => 'Buy plan a',
					'price'       => 200000,
					'type'        => 'plus',
					'currency'    => 'IRT',
					'description' => T_("Period One month"),
				],
				[
					'title'       => 'Vat',
					'price'       => 200,
					'type'        => 'plus',
					'currency'    => 'IRT',
					'description' => T_("Vat"),
				],
				[
					'title'       => 'Discount',
					'price'       => 150000,
					'type'        => 'minus',
					'currency'    => 'IRT',
					'description' => T_("Vat"),
				],
			];

		$result['total'] =
			[
				"price"    => 198000,
				"currency" => 'IRT',
			];

		$result['access'] =
			[
				'ok'     => false,
				'reason' => T_("You must discart current plan"),
				'type'   => 'error',
			];

		$result['user'] =
			[
				'budget' => \dash\db\transactions::budget(\dash\user::id()),
			];

		$result['detail'] =
			[

				[
					'title' => T_("Plan"),
					'value' => T_("Gold"),
				],
				[
					'title' => T_("Start date"),
					'value' => \dash\fit::date(date("Y-m-d")),
				],
			];

		$result['meta'] =
			[

				'action_title' => T_("Register new plan"),
				'plan_title' => T_("Gold"),
				'period_title' => T_("One year"),

			];
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

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}

}
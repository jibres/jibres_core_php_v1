<?php

namespace lib\app\plan;

class planFactor
{

	public static function calculate($_business_id, array $_args)
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

		return $result;
	}

}
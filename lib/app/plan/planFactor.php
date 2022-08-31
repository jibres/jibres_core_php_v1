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
					'descritpion' => T_("Period One month"),
				],
				[
					'title'       => 'Vat',
					'price'       => 200,
					'type'        => 'plus',
					'currency'    => 'IRT',
					'descritpion' => T_("Vat"),
				],
				[
					'title'       => 'Discount',
					'price'       => 150000,
					'type'        => 'minus',
					'currency'    => 'IRT',
					'descritpion' => T_("Vat"),
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

		return $result;
	}

}
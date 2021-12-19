<?php
namespace lib\app\order;


class get
{

	public static function customer_debt($_factor_id, $_customer_id, $_current_factor_total)
	{
		$customer_id = \dash\coding::decode($_customer_id);

		if(!$customer_id || !is_numeric($customer_id))
		{
			return false;
		}

		$current_debt = \dash\app\transaction\budget::user($customer_id);

		$debt_until_order = \lib\db\orders\get::debt_until_order($_factor_id, $customer_id);

		$debt_with_order = 0;

		$result                     = [];
		$result['debt_until_order'] = $debt_until_order;
		$result['debt_with_order']  = $debt_until_order - floatval($_current_factor_total);
		$result['current_debt']     = $current_debt;
		return $result;

	}
}
?>
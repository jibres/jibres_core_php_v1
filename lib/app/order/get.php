<?php
namespace lib\app\order;


class get
{
	/**
	 * Load id by check type
	 *
	 * @param      <type>  $_id    The identifier
	 * @param      string  $_type  The type
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function load_with_special_type($_id, $_type)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_with_special_type = \lib\db\orders\get::load_with_special_type($id, $_type);

		if(!$load_with_special_type)
		{
			\dash\notif::error(T_("Order by this special type not found"));
			return false;
		}

		$order = ready::row($load_with_special_type);

		return $order;
	}






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
		$result['display_detail']   = true;

		if(intval($debt_until_order) === 0 && intval($current_debt) === 0)
		{
			$result['display_detail']   = false;
		}


		return $result;

	}
}
?>
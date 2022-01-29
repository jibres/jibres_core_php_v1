<?php
namespace lib\app\discount;


class edit
{

	public static function edit($_args, $_id)
	{
		\dash\permission::access('manageDiscountCode');

		$load = \lib\app\discount\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$args = \lib\app\discount\check::variable($_args, $_id);

		if(!$args)
		{
			return false;
		}


		$args = \dash\cleanse::patch_mode($_args, $args);


		$temp_args = $args;

		unset($args['product_category']);
		unset($args['special_products']);
		unset($args['customer_group']);
		unset($args['special_customer']);

		if(a($args, 'code') && a($args, 'status') === 'enable')
		{
			$check_duplicate_title = \lib\db\discount\get::check_duplicate_code($args['code']);

			if(isset($check_duplicate_title['id']))
			{
				if(floatval($check_duplicate_title['id']) === floatval($load['id']))
				{
					// nothing
				}
				else
				{
					\dash\notif::error(T_("This discount code is exist in your list. Try another"));
					return false;
				}
			}
		}

		foreach ($args as $key => $value)
		{
			if(\dash\validate::is_equal($value, a($load, $key)))
			{
				unset($args[$key]);
			}
		}

		$is_used = \lib\db\factors\get::check_used_discount_id($load['id']);
		if($is_used)
		{

			if(array_key_exists('percentage', $args) || array_key_exists('fixedamount', $args) || array_key_exists('type', $args))
			{
				\dash\notif::warn(T_("After use discount code, can not edit type or discount value!"));
				unset($args['type']);
				unset($args['percentage']);
				unset($args['fixedamount']);
			}

		}

		if(!empty($args))
		{

			//
			$args['datemodified'] = date("Y-m-d H:i:s");

			\lib\db\discount\update::update($args, $load['id']);
		}

		dedicated::sync($temp_args, $load['id']);

		return true;
	}

}
?>
<?php
namespace lib\app\discount;


class add
{

	public static function add($_args)
	{

		$args = \lib\app\discount\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$check_duplicate_title = \lib\db\discount\get::check_duplicate_code($args['code']);

		if(isset($check_duplicate_title['id']))
		{
			\dash\notif::error(T_("This discount code is exist in your list. Try another"));
			return false;
		}

		$args['status']      = 'draft';
		$args['creator']     = \dash\user::id();
		$args['datecreated'] = date("Y-m-d H:i:s");

		$temp_args = $args;

		unset($args['product_category']);
		unset($args['special_products']);
		unset($args['customer_group']);
		unset($args['special_customer']);

		$id = \lib\db\discount\insert::new_record($args);


		dedicated::sync($temp_args, $id);
		// \dash\notif::ok(T_("Discount code successfully added"));

		return ['id' => $id];
	}


	public static function duplicate($_args, $_id)
	{
		$args = \lib\app\discount\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$load = \lib\app\discount\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$check_duplicate_title = \lib\db\discount\get::check_duplicate_code($args['code']);

		if(isset($check_duplicate_title['id']))
		{
			\dash\notif::error(T_("This discount code is exist in your list. Try another"));
			return false;
		}

		$new_id = \lib\db\discount\insert::duplicate($load['id'], $args['code']);

		if(!$new_id)
		{
			\dash\notif::error(T_("Can not create duplicate from your discount code"));
			return false;
		}

		\dash\notif::error(T_("Discount was duplicate"));
		return ['id' => $new_id];

	}

}
?>
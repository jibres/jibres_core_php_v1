<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class edit
{

	public static function update_cart($_product_id, $_count)
	{
		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		// check count < stock of this product and count < 9999
		if(!is_numeric($_count))
		{
			\dash\notif::error(T_("Please set count product as a number"));
			return false;
		}

		if(!$_count)
		{
			\dash\notif::error(T_("Please set count product"));
			return false;
		}

		if(intval($_count) <= 0)
		{
			\dash\notif::error(T_("Please set count product"));
			return false;
		}

		if(\dash\number::is_larger($_count, 9999))
		{
			\dash\notif::error(T_("Data is out of range for column count"));
			return false;
		}


		$load_product = \lib\app\product\get::inline_get($_product_id);
		if(!$load_product)
		{
			return false;
		}


		$check_exist_record = \lib\db\cart\get::product_user($_product_id, \dash\user::id());

		if(!isset($check_exist_record['count']))
		{
			\dash\notif::warn(T_("This product not exists in you cart"));
			return null;
		}
		else
		{

			$new_count = intval($_count) + intval($check_exist_record['count']);

			\lib\db\cart\update::the_count($_product_id, \dash\user::id(), $new_count);
		}

		\dash\notif::ok(T_("Your cart was updated"));
		return true;
	}
}
?>
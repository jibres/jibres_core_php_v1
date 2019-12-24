<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class remove
{

	public static function from_cart($_product_id)
	{
		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"));
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

			\lib\db\cart\delete::by_product_user($_product_id, \dash\user::id());
		}

		\dash\notif::ok(T_("The product was removed from your cart"));
		return true;
	}
}
?>
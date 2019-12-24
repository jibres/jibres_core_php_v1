<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class add
{

	public static function new_cart($_product_id, $_count)
	{
		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"));
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

		if(!$check_exist_record)
		{
			$new_record =
			[
				'user_id'    => \dash\user::id(),
				'product_id' => $_product_id,
				'count'      => $_count,
				'date'       => date("Y-m-d H:i:s"),
			];

			\lib\db\cart\insert::new_record($new_record);
		}
		else
		{
			\dash\notif::info(T_("This product exists in you cart"));
			return null;
		}

		\dash\notif::ok(T_("Product added to your cart"));
		return true;
	}
}
?>
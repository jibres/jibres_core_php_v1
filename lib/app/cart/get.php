<?php
namespace lib\app\cart;


class get
{

	public static function my_cart_list()
	{
		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_cart = \lib\db\cart\get::user_cart(\dash\user::id());

		if(!$user_cart)
		{
			\dash\notif::info(T_("Your cart is empty!"));
			return null;
		}

		$product_ids = array_column($user_cart, 'product_id');
		$product_ids = array_filter($product_ids);
		$product_ids = array_unique($product_ids);

		if(!$product_ids)
		{
			\dash\notif::info(T_("No product founded in your cart!"));
			return null;
		}

		$load_product_detail = \lib\app\product\get::multi_product($product_ids);
		$load_product_detail = array_combine(array_column($load_product_detail, 'id'), $load_product_detail);

		foreach ($user_cart as $key => $value)
		{
			if(isset($load_product_detail[$value['product_id']]))
			{
				$user_cart[$key]['product_detail'] = $load_product_detail[$value['product_id']];
			}
			unset($user_cart[$key]['user_id']);
		}
		return $user_cart;
	}
}
?>
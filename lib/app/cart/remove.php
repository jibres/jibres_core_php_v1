<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class remove
{


	public static function from_cart($_product_id, $_user_id = null)
	{
		$user_guest = null;

		if(!\dash\user::id())
		{
			$user_guest = \dash\user::get_user_guest();
			if(!$user_guest)
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		$user_id = null;
		if(\dash\user::login())
		{
			if(!$_user_id)
			{
				$user_id = \dash\user::code();
			}
			else
			{
				$user_id = $_user_id;
			}
			$user_id = \dash\coding::decode($user_id);
		}


		$condition =
		[
			'user_id' => 'id',
			'product' => 'id',
		];

		$args =
		[
			'user_id' => $user_id,
			'product' => $_product_id,
		];

		$require = ['product'];
		$meta    =	[];
		$data    = \dash\cleanse::input($args, $condition, $require, $meta);


		$load_product = \lib\app\product\get::inline_get($data['product']);
		if(!$load_product)
		{
			return false;
		}

		if($user_id)
		{
			$check_exist_record = \lib\db\cart\get::product_user($data['product'], $user_id);
		}
		else
		{
			$check_exist_record = \lib\db\cart\get::product_user_guest($data['product'], $user_guest);
		}


		if(!isset($check_exist_record['count']))
		{
			\dash\notif::warn(T_("This product not exists in you cart"));
			return null;
		}
		else
		{
			if($user_id)
			{
				\lib\db\cart\delete::by_product_user($data['product'], $user_id);
			}
			else
			{
				\lib\db\cart\delete::by_product_user_guest($data['product'], $user_guest);
			}
		}

		\dash\notif::ok(T_("The product was removed from your cart"));
		return true;
	}


}
?>
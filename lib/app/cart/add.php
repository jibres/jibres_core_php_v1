<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class add
{

	public static function new_cart_website($_product_id, $_count)
	{
		if(\dash\user::id())
		{
			return self::new_cart($_product_id, $_count);
		}

		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"). ' Nedd to fix');
			return false;
		}

		$condition =
		[
			'product' => 'id',
			'count'   => 'smallint',
		];

		$args =
		[
			'product' => $_product_id,
			'count'   => $_count,
		];

		$require = ['product', 'count'];
		$meta    = [];
		$data    = \dash\cleanse::input($args, $condition, $require, $meta);


		$load_product = \lib\app\product\get::inline_get($data['product']);
		if(!$load_product)
		{
			return false;
		}

		$check_exist_record = \dash\session::get('user_cart');


		if(!$check_exist_record)
		{
			$price = null;
			if(isset($load_product['finalprice']) && is_numeric($load_product['finalprice']))
			{
				$price = $load_product['finalprice'];
			}

			$new_record =
			[
				'user_id'         => $user_id,
				'product_id'      => $data['product'],
				'count'           => $data['count'],
				'datecreated'     => date("Y-m-d H:i:s"),
				'price'           => $price,
				'productprice_id' => \lib\db\products\get::last_productprice_id($data['product']),
			];

			\lib\db\cart\insert::new_record($new_record);
		}
		else
		{
			$new_count = floatval($check_exist_record['count']) + 1;

			\lib\db\cart\update::the_count($data['product'], $user_id, $new_count);

		}

		\dash\notif::ok(T_("Product added to your cart"));
		return true;
	}




	public static function new_cart($_product_id, $_count, $_user_id = null)
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

		if(!$_user_id)
		{
			$user_id = \dash\user::code();
		}
		else
		{
			$user_id = $_user_id;
		}

		$condition =
		[
			'user_id' => 'code',
			'product' => 'id',
			'count'   => 'smallint',
		];

		$args =
		[
			'user_id' => $user_id,
			'product' => $_product_id,
			'count'   => $_count,
		];

		$require = ['product', 'count', 'user_id'];
		$meta    =	[];
		$data    = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id = \dash\coding::decode($data['user_id']);

		$load_product = \lib\app\product\get::inline_get($data['product']);
		if(!$load_product)
		{
			return false;
		}


		$check_exist_record = \lib\db\cart\get::product_user($data['product'], $user_id);

		if(!$check_exist_record)
		{
			$price = null;
			if(isset($load_product['finalprice']) && is_numeric($load_product['finalprice']))
			{
				$price = $load_product['finalprice'];
			}

			$new_record =
			[
				'user_id'         => $user_id,
				'product_id'      => $data['product'],
				'count'           => $data['count'],
				'datecreated'     => date("Y-m-d H:i:s"),
				'price'           => $price,
				'productprice_id' => \lib\db\products\get::last_productprice_id($data['product']),
			];

			\lib\db\cart\insert::new_record($new_record);
		}
		else
		{
			$new_count = floatval($check_exist_record['count']) + 1;

			\lib\db\cart\update::the_count($data['product'], $user_id, $new_count);
		}

		\dash\notif::ok(T_("Product added to your cart"));
		return true;
	}
}
?>
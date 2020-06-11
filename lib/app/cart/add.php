<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class add
{
	// public static function admin_add($_product_detail, $_userdetail)
	// {
	// 	$cart_user = \lib\app\cart\check::cart_user($_userdetail);

	// 	if(!$cart_user)
	// 	{
	// 		return false;
	// 	}

	// 	$customer = $cart_user['customer'];

	// 	$condition =
	// 	[
	// 		'cart_list'    => ['product' => 'id', 'count' => 'smallint'],
	// 	];

	// 	$require = [];

	// 	$meta    =	[];

	// 	$data = \dash\cleanse::input(['cart_list' => $_product_detail], $condition, $require, $meta);

	// 	$product_ids = [];

	// 	if(isset($data['cart_list']) && is_array($data['cart_list']))
	// 	{
	// 		$product_ids = array_column($data['cart_list'], 'product');
	// 		$product_ids = array_filter($product_ids);
	// 		$product_ids = array_unique($product_ids);

	// 		if(!$product_ids)
	// 		{
	// 			\dash\notif::error(T_("No product found to be added to cart"));
	// 			return false;
	// 		}

	// 		$check_true_product = \lib\db\products\get::by_multi_id(implode(',', $product_ids));
	// 		if($check_true_product && is_array($check_true_product) && count($check_true_product) === count($product_ids))
	// 		{
	// 			// nothign. everything is ok
	// 		}
	// 		else
	// 		{
	// 			\dash\notif::error(T_("Some product id is not valid"));
	// 			return false;
	// 		}
	// 	}
	// 	else
	// 	{
	// 		\dash\notif::error(T_("Please choose some product for adding to cart"));
	// 		return false;
	// 	}

	// 	$check_exist_record = \lib\db\cart\get::multi_product_user(implode(',', $product_ids), $customer);

	// 	if(!is_array($check_exist_record))
	// 	{
	// 		$check_exist_record = [];
	// 	}

	// 	$insert_multi = [];
	// 	foreach ($data['cart_list'] as $key => $value)
	// 	{
	// 		if(isset($value['product']) && in_array($value['product'], $check_exist_record))
	// 		{
	// 			// nothing
	// 		}
	// 		else
	// 		{
	// 			$insert_multi[] =
	// 			[
	// 				'user_id'     => $customer,
	// 				'product_id'  => $value['product'],
	// 				'count'       => $value['count'],
	// 				'datecreated' => date("Y-m-d H:i:s"),
	// 			];
	// 		}
	// 	}

	// 	if(!empty($insert_multi))
	// 	{
	// 		\lib\db\cart\insert::multi_insert($insert_multi);
	// 	}

	// }





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
			$new_record =
			[
				'user_id'     => $user_id,
				'product_id'  => $data['product'],
				'count'       => $data['count'],
				'datecreated' => date("Y-m-d H:i:s"),
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
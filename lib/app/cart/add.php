<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class add
{
	public static function assing_to_user($_guest_id, $_user_id, $_force = false)
	{
		// force is from website. user login and need to assing cart to user
		if(!$_force)
		{
			\dash\permission::access('manageCart');
		}

		$condition =
		[
			'user_id' => 'code',
			'guestid' => 'md5',
		];

		$args =
		[
			'user_id' => $_user_id,
			'guestid' => $_guest_id,
		];

		$require = ['guestid', 'user_id'];

		$meta    = [];

		$data    = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id = \dash\coding::decode($data['user_id']);

		\lib\db\cart\update::assing_to_user($data['guestid'], $user_id);

		if(!$_force)
		{
			\dash\notif::ok(T_("Cart assigned to user"));
		}

		return true;

	}


	public static function new_cart_website($_product_id, $_count)
	{
		if(\dash\user::id())
		{
			return self::new_cart($_product_id, $_count, \dash\user::code(), null, 'website');
		}
		else
		{
			$user_guest = \dash\user::get_user_guest();
			if($user_guest)
			{
				return self::new_cart($_product_id, $_count, null, $user_guest, 'website');
			}
			else
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}
	}




	public static function new_cart($_product_id, $_count, $_user_id = null, $_user_guest = null, $_mode = null)
	{
		// check is not bot
		// if the agent is bot exit code!
		\dash\validate::is_not_bot();


		if($_mode !== 'website')
		{
			if(!\dash\user::id())
			{
				// save in session
				// in api we have the user id
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}

			\dash\permission::access('manageCart');

		}

		if(!$_user_id)
		{
			$user_id = \dash\user::code();
		}
		else
		{
			$user_id = $_user_id;
		}

		return self::add($_product_id, $_count, $user_id, $_user_guest, $_mode);

	}



	public static function add($_product_id, $_count, $_user_id, $_guest_id, $_mode = null)
	{
		$condition =
		[
			'user_id' => 'code',
			'guestid' => 'md5',
			'product' => 'id',
			'count'   => 'smallint',
		];

		$args =
		[
			'user_id' => $_user_id ? $_user_id : null,
			'guestid' => $_guest_id,
			'product' => $_product_id,
			'count'   => $_count,
		];

		$require = ['product', 'count'];

		$meta    = [];

		$data    = \dash\cleanse::input($args, $condition, $require, $meta);

		$guestid = $data['guestid'];

		$user_id = \dash\coding::decode($data['user_id']);

		$load_product = \lib\app\product\get::inline_get($data['product']);
		if(!$load_product)
		{
			\dash\notif::error(T_("Invalid product"));
			return false;
		}

		if(isset($load_product['variant_child']) && $load_product['variant_child'])
		{
			\dash\notif::error(T_("This product has different types. Please specify one of these types"));
			return false;
		}


		if($data['user_id'])
		{
			$user_id = \dash\coding::decode($data['user_id']);
			$check_exist_record = \lib\db\cart\get::product_user($data['product'], $user_id);
		}
		elseif($guestid)
		{
			$check_exist_record = \lib\db\cart\get::product_user_guest($data['product'], $guestid);
		}
		else
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$ready_product = \lib\app\product\ready::row($load_product);
		if(isset($ready_product['allow_shop']) && $ready_product['allow_shop'])
		{
			// nothing
		}
		else
		{
			\dash\notif::error(T_("Can not add this product to your cart"));
			return false;
		}

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
				'guestid'         => $guestid,
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

			if($data['user_id'])
			{
				\lib\db\cart\update::the_count($data['product'], $user_id, $new_count);
			}
			elseif($guestid)
			{
				\lib\db\cart\update::the_count_guest($data['product'], $guestid, $new_count);
			}
			else
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		\dash\notif::ok(T_("Product added to your cart"));
		return true;
	}
}
?>
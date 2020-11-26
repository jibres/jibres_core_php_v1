<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class remove
{

	public static function expired()
	{
		if(!\dash\session::get('checkExpiredCart_'. \lib\store::id()))
		{
			\dash\session::set('checkExpiredCart_'. \lib\store::id(), true);

			$date = date("Y-m-d H:i:s", strtotime("-30 days"));
			$count = \lib\db\cart\get::must_deleted_expired($date);

			if($count)
			{
				\lib\db\cart\delete::must_deleted_expired($date);
			}
		}
	}


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
			// $user_id = \dash\coding::decode($user_id);
		}

		return self::remove($_product_id, $user_id, $user_guest, true);

	}


	public static function remove_all($_user_id, $_guest_id)
	{
		\dash\permission::access('manageCart');

		$condition =
		[
			'user_id' => 'code',
			'guestid' => 'md5',
		];

		$args =
		[
			'guestid' => $_guest_id,
			'user_id' => $_user_id ? $_user_id : null,
		];

		$require = [];
		$meta    =	[];
		$data    = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id    = \dash\coding::decode($data['user_id']);

		$user_guest = $data['guestid'];

		if($user_id)
		{
			\lib\db\cart\delete::by_user_id($user_id);
		}
		else
		{
			\lib\db\cart\delete::by_guest_id($user_guest);
		}

		\dash\notif::ok(T_("Cart removed"));
		return true;
	}


	public static function remove($_product_id, $_user_id, $_guest_id, $_from_website = false)
	{
		if(!$_from_website)
		{
			\dash\permission::access('manageCart');
		}

		$condition =
		[
			'user_id' => 'code',
			'product' => 'id',
			'guestid' => 'md5',
		];

		$args =
		[
			'guestid' => $_guest_id,
			'user_id' => $_user_id ? $_user_id : null,
			'product' => $_product_id,
		];

		$require = ['product'];
		$meta    =	[];
		$data    = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id    = \dash\coding::decode($data['user_id']);

		$load_product = \lib\app\product\get::inline_get($data['product']);

		$user_guest = $data['guestid'];

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
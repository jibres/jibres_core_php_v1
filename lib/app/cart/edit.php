<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class edit
{

	public static function update_cart($_product_id, $_count, $_user_id = null, $_type = null)
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

		}

		return self::edit($_product_id, $_count, $user_id, $user_guest, $_type, true);

	}


	public static function edit($_product_id, $_count, $_user_id, $_guestid, $_type = null, $_from_website = false)
	{

		if(!$_from_website)
		{
			\dash\permission::access('manageCart');
		}

		$condition =
		[
			'guestid' => 'md5',
			'user_id' => 'code',
			'product' => 'id',
			'count'   => 'smallint',
			'type'    => ['enum' => ['plus_count', 'minus_count', 'update_count']],
		];

		$args =
		[
			'guestid' => $_guestid,
			'user_id' => $_user_id ? $_user_id : null,
			'product' => $_product_id,
			'count'   => $_count,
			'type'    => $_type,
		];

		$require = ['product'];

		$meta    =	[];

		$data    = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id    = \dash\coding::decode($data['user_id']);

		$user_guest = $data['guestid'];

		if(!$user_id && !$user_guest)
		{
			\dash\notif::error(T_("User identify error"));
			return false;
		}

		$load_product = \lib\app\product\get::inline_get($data['product']);

		if(!$load_product)
		{
			\dash\notif::error(T_("Invalid product"));
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
			$new_count = intval($data['count']);

			if($data['type'] === 'plus_count')
			{
				$new_count = floatval($check_exist_record['count']) + $new_count;
			}
			elseif($data['type'] === 'minus_count')
			{
				$new_count = floatval($check_exist_record['count']) - $new_count;
			}
			elseif($data['type'] === 'update_count')
			{
				$new_count = floatval($new_count);
			}

			if($new_count < 0)
			{
				$new_count = 0;
			}

			if($new_count === floatval(0))
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
			else
			{

				if($_from_website)
				{
					$new_count = \lib\app\cart\check::max_limit_product($new_count, $load_product, $data['type']);
				}

				if($user_id)
				{
					\lib\db\cart\update::the_count($_product_id, $user_id, $new_count);
				}
				else
				{
					\lib\db\cart\update::the_count_guest($_product_id, $user_guest, $new_count);
				}
			}

		}


		if(!$_from_website)
		{
			\dash\notif::ok(T_("Your cart was updated"));
		}
		return true;
	}


}
?>
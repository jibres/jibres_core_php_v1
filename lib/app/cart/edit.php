<?php
namespace lib\app\cart;

/**
 * Add cart
 */
class edit
{




	public static function update_cart($_product_id, $_count, $_user_id = null)
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

		if(!isset($check_exist_record['count']))
		{
			\dash\notif::warn(T_("This product not exists in you cart"));
			return null;
		}
		else
		{
			$new_count = intval($data['count']);

			if($new_count === 0)
			{
				\lib\db\cart\delete::by_product_user($data['product'], $user_id);
			}
			else
			{
				\lib\db\cart\update::the_count($_product_id, $user_id, $new_count);
			}

		}


		\dash\notif::ok(T_("Your cart was updated"));
		return true;
	}


}
?>
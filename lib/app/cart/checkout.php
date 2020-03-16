<?php
namespace lib\app\cart;


class checkout
{

	public static function user_cart($_args)
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

		$condition =
		[
			'address_id'      => 'id',

		];

		$require = ['address_id'];

		$meta =	[];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		$address_id = $data['address_id'];

		$address_detail = \dash\app\address::get($address_id);
		if(!$address_detail)
		{
			\dash\notif::error(T_("Invalid address id"));
			return false;
		}

		if(isset($address_detail['user_id']) && intval(\dash\coding::decode($address_detail['user_id'])) === intval(\dash\user::id()))
		{
			// nothing
		}
		else
		{
			\dash\notif::error(T_("Invalid address id!"));
			return false;
		}

		$user_cart = \lib\db\cart\get::user_cart(\dash\user::id());
		if(!$user_cart)
		{
			\dash\notif::error(T_("Your cart is empty"));
			return false;
		}

		$factor                = [];
		$factor['customer']    = \dash\coding::encode(\dash\user::id());
		$factor['type']     = 'sale';

		$factor_detail = [];
		foreach ($user_cart as $key => $value)
		{
			$factor_detail[] =
			[
				'product' => $value['product_id'],
				'count'   => $value['count'],
			];
		}

		$new_factor = \lib\app\factor\add::new_factor($factor, $factor_detail);

		return $new_factor;

	}
}
?>
<?php
namespace lib\app\factor;


class cart
{

	/**
	 * add new factor
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function to_factor($_args)
	{
		$condition =
		[

			'title'       => 'string_40',
			'name'        => 'displayname',
			'mobile'      => 'mobile',

			'company'     => 'bit',
			'country'     => 'country',
			'province'    => 'province',
			'city'        => 'city',
			'address'     => 'address',
			'address2'    => 'address',
			'postcode'    => 'postcode',
			'phone'       => 'phone',
			'fax'         => 'phone',



			'address_id' => 'code',
			'payway'     => ['enum' => ['online']],
		];

		$user_id    = \dash\user::id();
		$user_guest = null;

		if(!$user_id)
		{
			$user_guest = \dash\user::get_user_guest();
			if(!$user_guest)
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		$require = ['payway'];

		if($user_id)
		{
			array_push($require, 'address_id');
		}
		else
		{
			array_push($require, 'address');
			array_push($require, 'mobile');

		}


		$meta =
		[
			'field_title' =>
			[
				'payway' => 'Payment',
				'address_id' => 'Address',
			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($user_id)
		{
			$user_cart = \lib\db\cart\get::user_cart($user_id);
		}
		else
		{
			$user_cart = \lib\db\cart\get::user_cart_guest($user_guest);
		}


		if(!$user_cart)
		{
			\dash\notif::info(T_("Your cart is empty!"));
			return null;
		}

		$factor             = [];
		$factor['customer'] = $user_id ? \dash\coding::encode($user_id): null;
		$factor['guestid']  = $user_guest;
		$factor['type']     = 'sale';
		$factor['desc']     = null;
		$factor['discount'] = null;

		$factor_detail = [];
		foreach ($user_cart as $key => $value)
		{
			$factor_detail[] =
			[
				'product'  => $value['product_id'],
				'count'    => $value['count'],
				'discount' => null,
			];

		}

		$return = [];

		$result = \lib\app\factor\add::new_factor($factor, $factor_detail, ['from_cart' => true]);
		if(isset($result['factor_id']))
		{
			$return['factor_id'] = $result['factor_id'];
			return $return;
		}

		return false;
	}
}
?>
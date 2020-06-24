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
			'address_id' => 'code',
			'payway'     => ['enum' => ['online']],
		];


		$require = ['payway', 'address_id'];

		$meta =
		[
			'field_title' =>
			[
				'payway' => 'Payment',
				'address_id' => 'Address',
			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}


		$user_cart = \lib\db\cart\get::user_cart(\dash\user::id());

		if(!$user_cart)
		{
			\dash\notif::info(T_("Your cart is empty!"));
			return null;
		}

		$factor             = [];
		$factor['customer'] = \dash\user::code();
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
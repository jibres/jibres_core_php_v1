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



			'desc'        => 'desc',
			'address_id' => 'code',
			'payway'     => ['enum' => ['online', 'bank', 'on_deliver', 'check']],
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
			if(!$data['address_id'])
			{
				\dash\notif::error(T_("Please choose yoru address"));
				return false;
			}
		}
		else
		{
			$user_cart = \lib\db\cart\get::user_cart_guest($user_guest);
			$data['address_id'] = null;
		}


		if(!$user_cart)
		{
			\dash\notif::info(T_("Your cart is empty!"));
			return null;
		}

		$factor             = [];
		$factor['customer'] = $user_id ? \dash\coding::encode($user_id): null;
		$factor['guestid']  = $user_guest;
		$factor['type']     = 'saleorder';
		$factor['status']   = 'order';
		$factor['desc']     = $data['desc'];
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

		// check can add new factor
		if(!isset($result['factor_id']) || !isset($result['price']))
		{
			\dash\notif::error(T_("Can not add your order."));
			\dash\log::set('orderErrorInsert');
			return false;

		}

		$return['factor_id'] = $result['factor_id'];

		$factor_id = $result['factor_id'];

		// set action log
		\lib\app\factor\action::set('order', $factor_id);

		if($data['address_id'])
		{
			$load_address = \dash\app\address::get($data['address_id']);

			$insert_factor_address = [];

			if(isset($load_address['id']))
			{
				$insert_factor_address =
				[
					'factor_id'    => \lib\app\factor\get::fix_id($result['factor_id']),
					'title'        => \dash\get::index($load_address, 'title'),
					'name'         => \dash\get::index($load_address, 'name'),
					'company'      => \dash\get::index($load_address, 'company'),
					'companyname'  => \dash\get::index($load_address, 'companyname'),
					'jobtitle'     => \dash\get::index($load_address, 'jobtitle'),
					'country'      => \dash\get::index($load_address, 'country'),
					'province'     => \dash\get::index($load_address, 'province'),
					'city'         => \dash\get::index($load_address, 'city'),
					'address'      => \dash\get::index($load_address, 'address'),
					'address2'     => \dash\get::index($load_address, 'address2'),
					'postcode'     => \dash\get::index($load_address, 'postcode'),
					'phone'        => \dash\get::index($load_address, 'phone'),
					'mobile'       => \dash\get::index($load_address, 'mobile'),
					'fax'          => \dash\get::index($load_address, 'fax'),
					'latitude'     => \dash\get::index($load_address, 'latitude'),
					'longitude'    => \dash\get::index($load_address, 'longitude'),
					'map'          => \dash\get::index($load_address, 'map'),
					'datecreated'  => date("Y-m-d H:i:s"),
				];
			}
		}
		else
		{
			$insert_factor_address =
			[
				'factor_id'    => \lib\app\factor\get::fix_id($result['factor_id']),
				'title'        => $data['title'],
				'name'         => $data['name'],
				'company'      => $data['company'],
				'country'      => $data['country'],
				'province'     => $data['province'],
				'city'         => $data['city'],
				'address'      => $data['address'],
				'address2'     => $data['address2'],
				'postcode'     => $data['postcode'],
				'phone'        => $data['phone'],
				'mobile'       => $data['mobile'],
				'fax'          => $data['fax'],
				'datecreated'  => date("Y-m-d H:i:s"),
			];
		}

		\lib\db\factoraddress\insert::new_record($insert_factor_address);


		if($user_id)
		{
			\lib\db\cart\delete::drop_cart($user_id);
		}
		else
		{
			\lib\db\cart\delete::drop_cart_guest($user_guest);
		}

		if($data['payway'] === 'online')
		{
			// set status on pending_pay
			\lib\app\factor\edit::status('pending_pay', $factor_id);

			// go to bank
			$meta =
			[
				'msg_go'        => T_("Pay order"),
				'auto_go'       => false,
				'auto_back'     => false,
				'final_msg'     => true,
				'turn_back'     => \dash\url::kingdom(). '/orders',
				'user_id'       => \dash\user::id() ? \dash\user::id() : 'unverify',
				'amount'        => abs($result['price']),
				'final_fn'      => ['/lib/app/factor/cart', 'after_pay'],
				'final_fn_args' => ['factor_id' => $result['factor_id']],
			];


			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				if(\dash\engine\content::api_content())
				{
					$msg = T_("Pay link :val", ['val' => $result_pay['url']]);
					\dash\notif::meta($result_pay);
					\dash\notif::ok($msg);
					return;
				}
				else
				{
					\dash\redirect::to($result_pay['url']);
				}
			}
			else
			{
				\dash\log::oops('generate_pay_error');
				return false;
			}

		}
		elseif($data['payway'] === 'on_deliver')
		{
			\lib\app\factor\edit::status('pending_verify', $factor_id);
			\lib\app\factor\action::set('pending_verify', $factor_id);
		}
		elseif($data['payway'] === 'bank')
		{
			\lib\app\factor\edit::status('pending_verify', $factor_id);
			\lib\app\factor\action::set('pending_verify', $factor_id);
		}
		elseif($data['payway'] === 'check')
		{
			\lib\app\factor\edit::status('pending_verify', $factor_id);
			\lib\app\factor\action::set('pending_verify', $factor_id);

		}


		return $return;

	}


	public static function after_pay($_args)
	{
		if(isset($_args['factor_id']))
		{
			$factor_id = \lib\app\factor\get::fix_id($_args['factor_id']);
			if($factor_id)
			{
				\lib\db\factors\update::record(['type' => 'sale', 'pay' => 1, 'status' => 'pending_verify', 'datemodified' => date("Y-m-d H:i:s")], $factor_id);
				\lib\app\factor\action::set('pay_successfull', $factor_id);
			}

		}
		else
		{
			\dash\log::set('payEngineErrorSendArgs');
		}
	}
}
?>
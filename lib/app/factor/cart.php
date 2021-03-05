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
	public static function to_factor($_args, $_user_id = null, $_user_guest = null, $_from_admin = false)
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

		$user_id = null;

		if($_from_admin)
		{
			$user_id = $_user_id;
			$user_id = \dash\coding::decode($user_id);

		}
		else
		{
			$user_id    = \dash\user::id();
		}

		if($_user_guest)
		{
			$user_guest = $_user_guest;
		}
		else
		{
			$user_guest = \dash\user::get_user_guest(true);
		}

		if(!$user_id)
		{
			if(!$user_guest)
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		$require = ['payway'];

		$need_address_text = false;

		if($user_id)
		{
			if(isset($_args['address_id']) && $_args['address_id'])
			{
				array_push($require, 'address_id');
			}
			else
			{
				$need_address_text = true;
				// array_push($require, 'address');
				array_push($require, 'mobile');
			}
		}
		else
		{
			$need_address_text = true;
			// array_push($require, 'address');
			array_push($require, 'mobile');
		}

		// in admin needless to get address
		if(\dash\url::content() === 'a')
		{
			$need_address_text = false;
		}

		$meta =
		[
			'field_title' =>
			[
				'payway'     => 'Payment',
				'address_id' => 'Address',
			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($user_id)
		{
			$user_cart = \lib\db\cart\get::user_cart($user_id);
			// if(!$data['address_id'])
			// {
			// 	\dash\notif::error(T_("Please choose yoru address"));
			// 	return false;
			// }
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


		if($data['payway'] === 'on_deliver')
		{
			$first_desc = null;
			switch ($data['payway'])
			{
				case 'bank':
					$first_desc = T_("Bank");
					break;
				case 'check':
					$first_desc = T_("Cheque");
					break;
				case 'on_deliver':
					$first_desc = T_("On deliver");
					break;
				case 'online':
					$first_desc = T_("Online");
					break;

				default:
					// nothing
					break;
			}
			if($first_desc)
			{
				$data['desc'] = $first_desc . ' - '. $data['desc'] ;
			}
		}

		$factor             = [];
		$factor['customer'] = $user_id ? \dash\coding::encode($user_id): null;
		$factor['guestid']  = $user_guest;
		$factor['type']     = 'saleorder';
		// $factor['status']   = '';
		$factor['desc']     = $data['desc'];
		$factor['discount'] = null;


		$fileMode = true;
		$factor_detail = [];
		foreach ($user_cart as $key => $value)
		{
			if(isset($value['type']) && $value['type'] != 'file')
			{
				$fileMode = false;
			}

			$factor_detail[] =
			[
				'product'  => $value['product_id'],
				'count'    => $value['count'],
				'discount' => null,
				'price'    => null,
			];

		}

		if(!$fileMode && $need_address_text)
		{
			if(!$data['address'])
			{
				\dash\notif::error(T_("Address is required"), 'address');
				return false;
			}
		}

		$return = [];

		$result = \lib\app\factor\add::new_factor($factor, $factor_detail, ['from_cart' => true, 'fileMode' => $fileMode]);

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
		\lib\app\factor\action::set('registered', $factor_id);

		if($data['address_id'])
		{
			$load_address = \dash\app\address::get($data['address_id']);

			$insert_factor_address = [];

			if(isset($load_address['id']))
			{
				$insert_factor_address =
				[
					'factor_id'    => \lib\app\factor\get::fix_id($result['factor_id']),
					'title'        => a($load_address, 'title'),
					'name'         => a($load_address, 'name'),
					// 'company'      => a($load_address, 'company'),
					'companyname'  => a($load_address, 'companyname'),
					'jobtitle'     => a($load_address, 'jobtitle'),
					'country'      => a($load_address, 'country'),
					'province'     => a($load_address, 'province'),
					'city'         => a($load_address, 'city'),
					'address'      => a($load_address, 'address'),
					'address2'     => a($load_address, 'address2'),
					'postcode'     => a($load_address, 'postcode'),
					'phone'        => a($load_address, 'phone'),
					'mobile'       => a($load_address, 'mobile'),
					'fax'          => a($load_address, 'fax'),
					'latitude'     => a($load_address, 'latitude'),
					'longitude'    => a($load_address, 'longitude'),
					'map'          => a($load_address, 'map'),
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
				// 'company'      => $data['company'],
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


		\dash\log::set('order_adminNewOrderBeforePay', ['my_id' => $result['factor_id'], 'my_id' => $result['factor_id'], 'my_amount' => $result['price'], 'my_currency' => \lib\store::currency()]);


		if($data['payway'] === 'online')
		{
			// set status on pending_pay
			\lib\app\factor\action::set('awaiting_payment', $factor_id);

			// go to bank
			$meta =
			[
				'msg_go'        => T_("Pay order"),
				'auto_go'       => false,
				'auto_back'     => false,
				'final_msg'     => true,
				'turn_back'     => \dash\url::kingdom(). '/orders/view?id='. $result['factor_id'],
				'user_id'       => \dash\user::id() ? \dash\user::id() : 'unverify',
				'amount'        => abs($result['price']),
				'currency'      => \lib\store::currency('code'),
				'factor_id'     => $result['factor_id'],
				'final_fn'      => ['/lib/app/factor/cart', 'after_pay'],
				'final_fn_args' =>
				[
					'factor_id'     => $result['factor_id'],
					'user_id'       => \dash\user::id(),
					'amount'        => abs($result['price']),
				],
			];


			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				if(\dash\url::is_api())
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
			\lib\app\factor\action::set('unpaid', $factor_id);
		}
		elseif($data['payway'] === 'bank')
		{
			\lib\app\factor\action::set('awaiting_verify_payment', $factor_id);
		}
		elseif($data['payway'] === 'check')
		{
			\lib\app\factor\action::set('awaiting_verify_payment', $factor_id);
		}

		if(\dash\user::id())
		{
			\dash\log::set('order_customerNewOrder', ['to' => \dash\user::id(), 'my_id' => $result['factor_id'], 'my_amount' => $result['price'], 'my_currency' => \lib\store::currency()]);
		}

		return $return;

	}


	public static function after_pay($_args, $_transaction_detail = [])
	{
		if(isset($_args['factor_id']))
		{
			$factor_id = \lib\app\factor\get::fix_id($_args['factor_id']);
			if($factor_id)
			{

				\lib\app\factor\action::set('successful_payment', $factor_id);

				if($_args['user_id'])
				{
					$currency = null;
					if(isset($_transaction_detail['currency']))
					{
						$currency = $_transaction_detail['currency'];
					}

					$insert_transaction =
					[
						'user_id'   => $_args['user_id'],
						'factor_id' => $factor_id,
						'title'     => T_("Pay order :val", ['val' => $factor_id]),
						'verify'    => 1,
						'minus'     => floatval($_args['amount']),
						'currency'  => $currency,
						'type'      => 'money',
					];

					$transaction_id = \dash\db\transactions::set($insert_transaction);
				}

				if(isset($_args['user_id']))
				{
					\dash\log::set('order_customerNewOrder', ['to' => $_args['user_id'], 'my_id' => $_args['factor_id'], 'my_amount' => $_args['amount'], 'my_currency' => \lib\store::currency()]);
				}

				\dash\log::set('order_adminNewOrderAfterPay', ['my_id' => $_args['factor_id'], 'my_amount' => $_args['amount'], 'my_currency' => \lib\store::currency()]);
			}

		}
		else
		{
			\dash\log::set('payEngineErrorSendArgs');
		}
	}
}
?>
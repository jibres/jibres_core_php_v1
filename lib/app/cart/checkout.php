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

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$address_id = $data['address_id'];

		$address_detail = \dash\app\address::get($address_id);
		if(!$address_detail)
		{
			\dash\notif::error(T_("Invalid address id"));
			return false;
		}

		if(isset($address_detail['user_id']) && floatval(\dash\coding::decode($address_detail['user_id'])) === floatval(\dash\user::id()))
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



	public static function cart_detail()
	{
		return self::detail();
	}


	public static function shipping_detail($_args = [])
	{
		return self::detail($_args);
	}



	public static function detail($_args = [])
	{

		/**

			TODO:
			- Need check if in cart mode update view and autoremove product

		 */
		$myCart               = [];


		$user_id    = null;
		$user_guest = null;

		if(\dash\user::id())
		{
			$user_id = \dash\user::id();
		}
		else
		{
			$user_guest = \dash\user::get_user_guest();
		}

		if(!$user_id)
		{
			if(!$user_guest)
			{
				return false;
			}
		}

		if($user_id)
		{
			$user_cart = \lib\db\cart\get::user_cart($user_id);
		}
		else
		{
			$user_cart = \lib\db\cart\get::user_cart_guest($user_guest);
		}

		$cart_list = \lib\app\cart\search::my_detail();

		if(!is_array($cart_list))
		{
			$cart_list = [];
		}


		$myCart['hideAddress'] = \lib\app\cart\get::detect_hide_address($cart_list);
		$myCart['list'] = $cart_list;

		$cart_setting = \lib\app\setting\get::cart_setting();

		$myCart['count']      = count($cart_list);
		$myCart['setting']    = $cart_setting;
		$myCart['total_full'] = 0;

		// pwa header
		\dash\data::cart_link(\dash\fit::number($myCart['count']));

		$factor             = [];
		$factor['type'] = 'saleorder';
		$factor['customer'] = \dash\user::code();

		$factor_detail = [];

		foreach ($user_cart as $key => $value)
		{
			$factor_detail[] =
			[
				'product'  => $value['product_id'],
				'count'    => $value['count'],
				'discount' => null,
				'price'    => null,
			];
		}

		$return = [];

		$factor_option =
		[
			'customer_mode'  => true,
			'only_calculate' => true,
			'discount_code'  => a($_args, 'discount_code'),
		];


		$result = \lib\app\factor\add::new_factor($factor, $factor_detail, $factor_option);


		$myCart['summary'] =
		[
			'subtotal'  => a($result, 'subprice'),
			'discount'  => a($result, 'subdiscount'),
			'subvat'    => a($result, 'subvat'),
			'shipping'  => a($result, 'shipping'),
			'total'     => a($result, 'total'),
			'discount2' => a($result, 'discount2'),
			'budget'    => a($result, 'budget'),
			'payable'    => a($result, 'payable'),
		];

		$myCart['payableString'] = \dash\fit::number($myCart['summary']['total']). ' '. \lib\store::currency() ;
		$myCart['discount_code'] = a($result, 'discount_code');


		// var_dump($factor, $factor_detail, $factor_option, $result, $myCart);exit;

		\dash\notif::clean();
		\dash\data::myCart($myCart);

	}



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
			'discount_code'        => 'discount_code',
			'title'                => 'string_40',
			'name'                 => 'displayname',
			'mobile'               => 'mobile',

			'company'              => 'bit',
			'country'              => 'country',
			'province'             => 'province',
			'city'                 => 'city',
			'address'              => 'address',
			'address2'             => 'address',
			'postcode'             => 'postcode',
			'phone'                => 'phone',
			'fax'                  => 'phone',

			'shipping_form_answer' => 'bit', // just for skipp error



			'desc'                 => 'desc',
			'address_id'           => 'code',
			'payway'               => ['enum' => ['online', 'bank', 'on_deliver', 'check', 'card']],
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

		if(\dash\url::content() !== 'a' && \lib\store::detail('forceloginorder') && !\dash\user::id())
		{
			$loginUrl = \lib\store::url(). '/enter?referer=cart';
			$msg = T_("Please login to continue");
			\dash\notif::error($msg, ['alerty' => true]);
			\dash\redirect::to($loginUrl);
			return false;
		}


		if($data['payway'] === 'on_deliver' || $data['payway'] === 'card')
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
				case 'card':
					$first_desc = T_("Card-to-card");
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

		if(!$factor['customer'] && $data['mobile'])
		{
			$new_user_id = \dash\app\user::quick_add(['mobile' => $data['mobile']]);
			if(is_numeric($new_user_id))
			{
				$factor['customer']	= \dash\coding::encode($new_user_id);
			}
		}

		if(isset($factor['customer']) && $factor['customer'])
		{
			$factor_user_id = \dash\coding::decode($factor['customer']);
		}
		else
		{
			\dash\notif::error(T_("Plese set mobile or login to continue"));
			return false;
		}

		$factor['guestid']  = $user_guest;
		$factor['type']     = 'saleorder';
		// $factor['status']   = '';
		$factor['desc']     = $data['desc'];
		$factor['discount'] = null;


		$hideAddress = true;
		$factor_detail = [];
		foreach ($user_cart as $key => $value)
		{
			if(isset($value['type']) && $value['type'] === 'product')
			{
				$hideAddress = false;
			}

			$factor_detail[] =
			[
				'product'  => $value['product_id'],
				'count'    => $value['count'],
				'discount' => null,
				'price'    => null,
			];

		}


		if(!$hideAddress && $need_address_text)
		{
			if(!$data['address'])
			{
				\dash\notif::error(T_("Address is required"), 'address');
				return false;
			}
		}

		$return = [];

		$factor_option =
		[
			'customer_mode' => true,
			'discount_code' => $data['discount_code'],
		];

		if(isset($_args['shipping_form_answer']) && $_args['shipping_form_answer'])
		{
			$factor_option['start_transaction'] = false;
			\dash\pdo::transaction();
		}


		$result = \lib\app\factor\add::new_factor($factor, $factor_detail, $factor_option);

		// check can add new factor
		if(!isset($result['factor_id']) || !isset($result['factor_total']))
		{
			if(\dash\temp::get('MSGORDERBUGNEEDFIX'))
			{
				\dash\notif::error(\dash\temp::get('MSGORDERBUGNEEDFIX'));
			}
			\dash\notif::error_once(T_("Can not add your order."));
			\dash\log::set('orderErrorInsert');
			return false;
		}

		if(isset($_args['shipping_form_answer']) && $_args['shipping_form_answer'])
		{
			$_args['shipping_form_answer']['factor_id'] = $result['factor_id'];

			\lib\app\form\answer\add::public_new_answer($_args['shipping_form_answer']);

			if(!\dash\engine\process::status())
			{
				\dash\notif::clean_ok();
				return false;
			}

			\dash\pdo::commit();
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

		\lib\db\factorshipping\insert::new_record($insert_factor_address);


		if($user_id)
		{
			\lib\db\cart\delete::drop_cart($user_id);
		}
		else
		{
			\lib\db\cart\delete::drop_cart_guest($user_guest);
		}


		\dash\log::set('order_adminNewOrderBeforePay', ['my_id' => $result['factor_id'], 'my_id' => $result['factor_id'], 'my_amount' => $result['factor_total'], 'my_currency' => \lib\store::currency()]);


		if($data['payway'] === 'online')
		{
			$final_fn_args =
			[
				'factor_id'    => $result['factor_id'],
				'user_id'      => $factor_user_id,
				'amount'       => abs($result['payable']),
				'factor_total' => abs($result['factor_total']),
			];

			if($result['payable'])
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
					'user_id'       => $factor_user_id,
					'amount'        => abs($result['payable']),
					'currency'      => \lib\store::currency('code'),
					'factor_id'     => $result['factor_id'],
					'final_fn'      => ['/lib/app/cart/checkout', 'after_pay'],
					'final_fn_args' => $final_fn_args,

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
			else
			{

				self::after_pay($final_fn_args);

				\lib\app\factor\action::set('successful_payment', $factor_id);

				// free price

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
		elseif($data['payway'] === 'card')
		{
			\lib\app\factor\action::set('awaiting_verify_payment', $factor_id);
		}

		if($factor_user_id)
		{
			\dash\log::set('order_customerNewOrder', ['to' => $factor_user_id, 'my_id' => $result['factor_id'], 'my_amount' => $result['factor_total'], 'my_currency' => \lib\store::currency()]);
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
				// need to check budget before minus transaction
				// @reza @todo

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
						'minus'     => floatval($_args['factor_total']),
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
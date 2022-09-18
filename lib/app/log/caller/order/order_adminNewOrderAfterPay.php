<?php
namespace lib\app\log\caller\order;


class order_adminNewOrderAfterPay
{

	private static $load_once_factor_detail = null;


	public static function site($_args = [])
	{
		$result = [];

		$result['title'] = T_("Hooray :)");

		$result['icon']      = 'buy';
		$result['cat']       = T_("Order");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args, false);

		$my_id         = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$result['txt'] .= ' <a target="_blank" class="link-primary" href="' . \lib\store::admin_url() . '/:' . $my_id . '">' . T_("Show order") . '</a>';
		$result['txt'] .= ' <br> ' . T_("Jibres; Sell and enjoy");
		return $result;

	}


	public static function get_msg($_args = [], $_link = true)
	{
		$msg         = '';
		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$my_amount   = isset($_args['data']['my_amount']) ? \dash\fit::number($_args['data']['my_amount']) : null;
		$my_currency = isset($_args['data']['my_currency']) ? $_args['data']['my_currency'] : null;
		$my_template = isset($_args['data']['template']) ? $_args['data']['template'] : null;

		if($my_template === null)
		{
			$my_template = \lib\app\setting\notification::get_template('after_pay');
		}

		switch ($my_template)
		{
			case '4':
			case 4:
				$msg .= T_("A new order was paid in the :business", ['business' => \lib\store::title()]);
				$msg .= self::get_msg_by_product_detail($my_id, $my_currency);
				$msg .= self::msg_fill_customer_detail($my_id);
				$msg .= self::msg_fill_customer_address($my_id);
				break;

			case '3':
			case 3:
				$msg .= T_("A new order was paid in the :business", ['business' => \lib\store::title()]);
				$msg .= self::get_msg_by_product_detail($my_id, $my_currency);
				break;

			case '2':
			case 2:
				$msg .= T_("A new order was paid in the :business", ['business' => \lib\store::title()]);
				// code...
				break;

			default:
			case '1':
			case 1:
				$msg .= "💰  " . T_("A final order and the amount of :amount :currency was paid in :business :)", ['amount'   => $my_amount,
																												  'currency' => $my_currency,
																												  'business' => \lib\store::title(),
					]);
				break;
		}

		if($_link)
		{
			if(!a($_args, 'data', 'my_hide_link'))
			{
				$msg .= "\n";
				$msg .= \lib\store::admin_url('raw') . '/:' . $my_id;
			}

			$msg .= "\n";
			$msg .= ' ' . T_("Jibres; Sell and enjoy");

		}

		return $msg;
	}


	public static function template_list($_args)
	{
		$template_list = [];

		foreach ([1, 2, 3, 4] as $key => $value)
		{
			$_args['data']['template'] = $value;
			$template_list[$value]     = self::get_msg($_args);
		}

		return $template_list;
	}


	private static function load_once_factor_detail($my_id)
	{
		if(self::$load_once_factor_detail === null)
		{
			$option                        =
				[
					'skipp_check_permission'  => true,
					'include_order_detail'    => true,
					'include_customer_detail' => true,
					'include_shipping_detail' => true,
					'include_action_detail'   => false,
					'include_discount_detail' => false,
				];
			self::$load_once_factor_detail = \lib\app\factor\get::full($my_id, $option);
		}

		return self::$load_once_factor_detail;
	}


	public static function get_msg_by_product_detail($my_id, $my_currency)
	{
		$msg = '';
		if($my_id && is_numeric(\lib\app\factor\get::fix_id($my_id)))
		{
			$load_factor = self::load_once_factor_detail($my_id);
			if(is_array($load_factor) && is_array(a($load_factor, 'factor_detail')))
			{
				foreach ($load_factor['factor_detail'] as $key => $value)
				{
					$msg .= "\n";
					$msg .= a($value, 'title');
					if(floatval(a($value, 'count')) > 1)
					{
						$msg .= " ";
						$msg .= \dash\fit::number($value['count']) . ' ' . a($value, 'unit');
					}

				}
			}

			$msg .= "\n";
			$msg .= T_("Total") . ' ' . \dash\fit::number(a($load_factor, 'factor', 'total'));
			$msg .= " ";
			$msg .= $my_currency;

		}
		elseif($my_id === '...')
		{
			$msg .= "\n";
			$msg .= T_("Product") . \dash\fit::number(1) . "\n";
			$msg .= T_("Product") . \dash\fit::number(2) . " " . \dash\fit::number(3) . ' ' . T_("Unit");
			$msg .= "\n";
			$msg .= T_("Total") . ' ...';
			$msg .= " ";
			$msg .= $my_currency;
		}

		return $msg;
	}


	public static function msg_fill_customer_detail($my_id)
	{
		$msg = '';

		if($my_id && is_numeric(\lib\app\factor\get::fix_id($my_id)))
		{
			$load_factor = self::load_once_factor_detail($my_id);

			$customer_detail = a($load_factor, 'factor', 'customer_detail');

			if(a($customer_detail, 'displayname') || a($customer_detail, 'mobile'))
			{
				$msg .= PHP_EOL;
				$msg .= T_("Customer") . PHP_EOL;

				if(a($customer_detail, 'displayname'))
				{
					$msg .= $customer_detail['displayname'] . PHP_EOL;
				}

				if(a($customer_detail, 'mobile'))
				{
					$msg .= \dash\fit::mobile($customer_detail['mobile']) . PHP_EOL;
				}

				$msg .= " ";

			}
		}
		elseif($my_id === '...')
		{

			$msg .= PHP_EOL;
			$msg .= T_("Customer") . PHP_EOL;
			$msg .= T_("Name") . PHP_EOL;
			$msg .= T_("Mobile") . PHP_EOL;
			$msg .= " ";
		}

		return $msg;
	}


	public static function msg_fill_customer_address($my_id)
	{
		$msg = '';

		if($my_id && is_numeric(\lib\app\factor\get::fix_id($my_id)))
		{
			$load_factor = self::load_once_factor_detail($my_id);

			$address = a($load_factor, 'address');


			if(a($address, 'address') || a($address, 'phone') || a($address, 'postcode'))
			{
				$msg .= PHP_EOL;
				$msg .= T_("Address") . PHP_EOL;

				if(a($address, 'address'))
				{
					$msg .= $address['address'] . PHP_EOL;
				}

				if(a($address, 'phone'))
				{
					$msg .= T_("Phone") . ' ' . \dash\fit::text($address['phone']) . PHP_EOL;
				}

				if(a($address, 'postcode'))
				{
					$msg .= T_("Postcode") . ' ' . \dash\fit::text($address['postcode']) . PHP_EOL;
				}

				$msg .= " ";

			}
		}
		elseif($my_id === '...')
		{

			$msg .= PHP_EOL;
			$msg .= T_("Address") . PHP_EOL;
			$msg .= T_("Phone") . PHP_EOL;
			$msg .= T_("Postcode") . PHP_EOL;
			$msg .= " ";
		}

		return $msg;
	}


	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60 * 60 * 24 * 3));
	}


	public static function is_notif()
	{
		return true;
	}


	public static function send_to()
	{
		return ['admin', 'orderNotificationReceiver'];
	}


	public static function telegram()
	{
		return true;
	}


	public static function sms()
	{
		return \lib\app\setting\notification::is_enable('after_pay');
	}


	public static function sms_user($_user_id)
	{
		return \lib\app\setting\notification::is_enable_user('after_pay', $_user_id);
	}


	public static function sms_text($_args, $_mobile)
	{
		$title = self::get_msg($_args);

		$sms =
			[
				'mobile' => $_mobile,
				'text'   => $title,
				'meta'   =>
					[
						'header' => false,
						'footer' => false,
					],
			];

		return json_encode($sms, JSON_UNESCAPED_UNICODE);
	}


	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#New_Order  ";

		$tg_msg .= " 🛒 \n";

		$tg_msg .= self::get_msg($_args);

		$tg            = [];
		$tg['chat_id'] = $_chat_id;
		$tg['text']    = $tg_msg;

		return $tg;

	}

}

?>
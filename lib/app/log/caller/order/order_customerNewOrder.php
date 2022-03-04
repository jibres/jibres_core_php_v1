<?php
namespace lib\app\log\caller\order;



class order_customerNewOrder
{

	public static function site($_args = [])
	{
		$result              = [];

		$result['title']     = T_("Your order was registered");

		$result['icon']      = 'buy';
		$result['cat']       = T_("Order");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);

		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$result['txt'] .= ' <a target="_blank" class="link" href="'. \lib\store::url(). '/:'. $my_id. '">'. T_("Show order"). '</a>';

		return $result;

	}



	public static function get_msg($_args = [])
	{
		$msg         = '';
		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$my_amount   = isset($_args['data']['my_amount']) ? \dash\fit::number($_args['data']['my_amount']) : null;
		$my_currency = isset($_args['data']['my_currency']) ? $_args['data']['my_currency'] : null;

		$my_template = isset($_args['data']['template']) ? $_args['data']['template'] : null;

		if($my_template === null)
		{
			$my_template = \lib\app\setting\notification::get_template('new_order');
		}

		switch ($my_template)
		{
			case '3':
			case 3:
				$msg .= T_("Your order was registered in :business", ['business' => \lib\store::title()]);
				$msg .= order_adminNewOrderAfterPay::get_msg_by_product_detail($my_id, $my_currency);
				break;

			case '2':
			case 2:
				$msg .= T_("Your order was registered in :business", ['business' => \lib\store::title()]);
				// code...
				break;

			default:
			case '1':
			case 1:
				$msg .= "❤️ ". T_("Your order in the amount of :amount :currency was registered in :business and we are preparing your order with the speed of light", ['amount' => $my_amount, 'currency' => $my_currency, 'business' => \lib\store::	title()]);
				break;
		}

		return $msg;
	}


	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60*60*24*3));
	}


	public static function is_notif()
	{
		return true;
	}


	public static function telegram()
	{
		return true;
	}



	public static function template_list($_args)
	{
		$template_list = [];

		foreach ([1, 2, 3] as $key => $value)
		{
			$_args['data']['template'] = $value;
			$template_list[$value] = self::get_msg($_args);
		}

		return $template_list;
	}




	public static function sms()
	{
		return \lib\app\setting\notification::is_enable('new_order');
	}



	public static function sms_user($_user_id)
	{
		return \lib\app\setting\notification::is_enable_user('new_order', $_user_id);
	}

	public static function sms_text($_args, $_mobile)
	{
		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$title = self::get_msg($_args);
		$title .= "\n";
		$title .= \lib\store::url('raw'). '/:'. $my_id;

		$sms =
		[
			'mobile' => $_mobile,
			'text'   => $title,
			'meta'   =>
			[
				'header' => false,
				'footer' => false
			]
		];

		return json_encode($sms, JSON_UNESCAPED_UNICODE);
	}


	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#New_Order  ";

		$tg_msg .= " 🛒 \n";

		$tg_msg .= self::get_msg($_args);

		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;

		$tg_msg .= "\n";
		$tg_msg .= \lib\store::url(). '/:'. $my_id;

		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
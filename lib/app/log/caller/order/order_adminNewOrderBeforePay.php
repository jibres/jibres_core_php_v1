<?php
namespace lib\app\log\caller\order;



class order_adminNewOrderBeforePay
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
		$result['txt'] .= ' <a target="_blank" class="link" href="'. \lib\store::admin_url(). '/:'. $my_id. '">'. T_("Show order"). '</a>';

		return $result;

	}



	public static function get_msg($_args = [])
	{
		$msg         = '';
		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$my_amount   = isset($_args['data']['my_amount']) ? \dash\fit::number($_args['data']['my_amount']) : null;
		$my_currency = isset($_args['data']['my_currency']) ? $_args['data']['my_currency'] : null;


		$msg .= "🛍  ". T_("A new order in the amount of :amount :currency was registered in :business. We, like you, are waiting to inform you after completing the payment", ['amount' => $my_amount, 'currency' => $my_currency, 'business' => \lib\store::title()]);

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


	public static function send_to()
	{
		return ['admin'];
	}



	public static function telegram()
	{
		return true;
	}


	public static function sms()
	{
		return false;
	}

	public static function sms_text($_args, $_mobile)
	{
		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$title = self::get_msg($_args);
		$title .= "\n";
		$title .= \lib\store::admin_url(). '/:'. $my_id;

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
		$tg_msg .= \lib\store::admin_url(). '/:'. $my_id;

		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
<?php
namespace lib\app\log\caller\order;



class order_adminNewOrderAfterPay
{

	public static function site($_args = [])
	{
		$result              = [];

		$result['title']     = T_("Hooray :)");

		$result['icon']      = 'buy';
		$result['cat']       = T_("Order");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args, false);

		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$result['txt'] .= ' <a target="_blank" class="link" href="'. \lib\store::admin_url(). '/:'. $my_id. '">'. T_("Show order"). '</a>';
		$result['txt'] .= ' <br> '. T_("Jibres; Sell and enjoy");
		return $result;

	}



	public static function get_msg($_args = [], $_link = true)
	{
		$msg         = '';
		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$my_amount   = isset($_args['data']['my_amount']) ? \dash\fit::number($_args['data']['my_amount']) : null;
		$my_currency = isset($_args['data']['my_currency']) ? $_args['data']['my_currency'] : null;


		$msg .= "💰  ". T_("A final order and the amount of :amount :currency was paid in :business :)", ['amount' => $my_amount, 'currency' => $my_currency, 'business' => \lib\store::title()]);
		if($_link)
		{
			$msg .= "\n";
			$msg .= \lib\store::admin_url(). '/:'. $my_id;
			$msg .= ' '. T_("Jibres; Sell and enjoy");
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
		return true;
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

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
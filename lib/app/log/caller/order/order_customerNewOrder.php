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
		return $result;

	}




	public static function get_msg($_args = [])
	{
		$msg = '';
		$my_id       = isset($_args['data']['my_id']) ? $_args['data']['my_id'] : null;
		$msg = T_("Your order was registered by code :val.", ['val' => $my_id]);
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


	public static function sms()
	{
		return false;
	}



	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#Order  ";

		$tg_msg .= " 🛒 \n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
<?php
namespace lib\app\log\caller\domain;



class domain_creditLow
{

	public static function site($_args = [])
	{
		$my_name         = isset($_args['data']['my_name']) ? $_args['data']['my_name'] : null;
		$result              = [];
		$result['title']     = T_("Domain credit low!");
		$result['icon']      = 'flag';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-red';
		$result['txt']       = self::get_msg($_args);
		return $result;
	}




	public static function get_msg($_args = [])
	{
		$msg        = '';
		$my_balance = isset($_args['data']['my_balance']) ? $_args['data']['my_balance'] : null;
		$msg        .= T_("Less than :val credits remain", ['val' => \dash\fit::number($my_balance)]);
		return $msg;
	}


	public static function send_to()
	{
		return ['supervisor'];
	}


	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60*60*24*7));
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
		$tg_msg .= "#Domain #IRNIC #Credit ";

		$tg_msg .= " 🔴 \n";

		$tg_msg .= T_("Domain credit low!");

		$tg_msg .= "\n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
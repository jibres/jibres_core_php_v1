<?php
namespace dash\app\log\caller\enter;


class enter_NewAccountLogin
{

	public static function site($_args = [])
	{

		// $my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;

		$result              = [];

		$result['title']     = T_("New login to your account");

		$result['icon']      = 'log-in';
		$result['cat']       = T_("Enter");
		$result['iconClass'] = 'fc-red';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';

		$msg.= T_("We have noticed a new login to your account");
		$msg .= "\n";
		$msg.= T_("Were you yourself?");
		$msg .= "\n";
		$msg.= T_("You can change your password or enable two-step login to make your account more secure");

		return $msg;
	}


	// public static function send_to()
	// {
	// 	return ['supervisor'];
	// }


	public static function expire()
	{
		// 3 days
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
		$tg_msg .= "#Enter #NewAccountLogin ";

		// $my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;


		$tg_msg .= " ⚠️ \n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
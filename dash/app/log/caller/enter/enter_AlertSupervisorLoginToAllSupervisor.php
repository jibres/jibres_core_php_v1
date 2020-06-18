<?php
namespace dash\app\log\caller\enter;


class enter_AlertSupervisorLoginToAllSupervisor
{

	public static function site($_args = [])
	{

		$result              = [];

		$result['title']     = T_("Supervisor was login to Jibres");

		$result['icon']      = 'atom';
		$result['cat']       = T_("Supervisor");
		$result['iconClass'] = 'fc-red';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';
		$user_id         = isset($_args['data']['my_user_id']) ? $_args['data']['my_user_id'] : null;
		$displayname         = isset($_args['data']['my_detail']['displayname']) ? $_args['data']['my_detail']['displayname'] : null;


		// if(floatval($user_id) === floatval(\dash\user::id()))
		// {
		// 	$msg.= T_("Your login was notifed to all other supervisor in jibres");
		// 	$msg .= "\n";
		// 	$msg.= T_("Have a good day ;)");
		// }
		// else
		// {
			$msg.= $displayname;
			$msg .= "\n";
			$msg.= T_("Was login to jibres.");
		// }

		return $msg;
	}


	public static function send_to()
	{
		return ['supervisor'];
	}


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
		$tg_msg .= "#Enter #SupervisorLoginToJibres ";

		// $my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;


		$tg_msg .= " 🟢 \n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
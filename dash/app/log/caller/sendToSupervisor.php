<?php
namespace dash\app\log\caller;


class sendToSupervisor
{

	public static function site($_args = [])
	{

		// $my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;

		$result              = [];

		$result['title']     = T_("Supervisor alert");

		$result['icon']      = 'flag';
		$result['cat']       = T_("Supervisor");
		$result['iconClass'] = 'fc-red';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';
		if(isset($_args['data']['my_text']))
		{
			$msg = $_args['data']['my_text'];
		}
		else
		{
			$msg = T_("Empty message!");
		}

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
		$tg_msg .= "#alert #supervisor ";

		$tg_msg .= " 📡 \n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
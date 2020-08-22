<?php
namespace dash\app\log\caller;


class sendNotifBySms
{

	public static function site($_args = [])
	{

		// $my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;

		$result              = [];

		$result['title']     = T_("Alert");

		$result['icon']      = 'flag';
		$result['cat']       = T_("Message");
		$result['iconClass'] = 'fc-blue';
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


	public static function expire()
	{
		// 3 days
		return date("Y-m-d H:i:s", time() + (60*60*24*10));
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
				'footer' => false,
				'header' => false,
			]
		];

		return json_encode($sms, JSON_UNESCAPED_UNICODE);
	}




	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#alert ";

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
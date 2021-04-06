<?php
namespace dash\app\log\caller\notif;


class notif_text
{
	public static function site($_args = [])
	{

		$result              = [];

		$result["title"]     = isset($_args['data']['notif_title']) ? $_args['data']['notif_title'] : null;
		$result["text"]      = isset($_args['data']['notif_text']) ? $_args['data']['notif_text'] : null;
		$result["group"]     = isset($_args['data']['notif_group']) ? $_args['data']['notif_group'] : null;

		$result['cat']       = $result['group'];
		$result['iconClass'] = 'fc-blue';
		$result['txt']       = $result['text'];

		return $result;

	}

	public static function expire()
	{
		return date("Y-m-d H:i:s", strtotime("+365 days")); // 1 year
	}


	public static function is_notif()
	{
		return true;
	}



	public static function telegram($_args = [])
	{
		if(isset($_args['data']['notif_sendtelegram']) && $_args['data']['notif_sendtelegram'])
		{
			return true;
		}

		return false;
	}


	public static function sms($_args = [])
	{
		if(isset($_args['data']['notif_sendsms']) && $_args['data']['notif_sendsms'])
		{
			return true;
		}

		return false;
	}


	public static function sms_text($_args, $_mobile)
	{
		$title = isset($_args['data']['notif_text']) ? $_args['data']['notif_text'] : null;

		$sms =
		[
			'mobile' => $_mobile,
			'text'   => $title,
			'meta'   =>
			[
				'footer' => false
			]
		];

		return json_encode($sms, JSON_UNESCAPED_UNICODE);
	}


	public static function telegram_text($_args, $_chat_id)
	{
		$title = isset($_args['data']['notif_text']) ? $_args['data']['notif_text'] : null;

		$tg_msg = '';

		$tg_msg .= $title;
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;
	}

}
?>
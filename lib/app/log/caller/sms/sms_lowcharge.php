<?php
namespace lib\app\log\caller\sms;



class sms_lowcharge
{

	public static function site($_args = [])
	{



		$result              = [];

		$result['title']     = T_("Your SMS package is running out");


		$result['icon']      = 'battery-empty';
		$result['cat']       = T_("SMS");
		$result['iconClass'] = 'text-red-800';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}




	public static function get_msg($_args = [], $_sms = false)
	{
		$msg                    = '';


		$my_business_title         = isset($_args['data']['my_business_title']) ? $_args['data']['my_business_title'] : null;
		$my_remain_count         = isset($_args['data']['my_remain_count']) ? $_args['data']['my_remain_count'] : null;

		if($_sms)
		{
			$msg .= T_("Your SMS package is running out"). "\n";
		}
		$msg .= T_("Please purchase a new SMS package in :val Business", ['val' => $my_business_title]);


		return $msg;
	}



	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60*60*24*7));
	}


	public static function save_user_detail()
	{
		return true;
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
		$title = self::get_msg($_args, true);

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
		$tg_msg .= "#sms #low_charge ";

		$tg_msg .= " ⌛️ \n";

		$tg_msg .= T_("Your SMS package is running out");

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
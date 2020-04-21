<?php
namespace lib\app\log\caller\domain;



class domain_irnicDomainApproved
{

	public static function site($_args = [])
	{

		$result              = [];
		$result['title']     = T_("Your domain register was approved");
		$result['icon']      = 'heartbeat';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';

		$domain = isset($_args['data']['mydomain']) ? $_args['data']['mydomain'] : null;

		$msg = T_("Register Domain :domain was approved", ['domain' => $domain]);

		return $msg;
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
		return true;
	}


	public static function sms_text($_args, $_mobile)
	{

		$sms =
		[
			'mobile' => $_mobile,
			'text'   => self::get_msg($_args),
			'meta'   =>
			[
				'footer' => false
			]
		];

		return json_encode($sms, JSON_UNESCAPED_UNICODE);
	}



	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#Domain\n";
		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;
		// $tg['reply_markup'] = \dash\app\log\support_tools::tg_btn2($code);
		// $tg = json_encode($tg, JSON_UNESCAPED_UNICODE);
		return $tg;

	}
}
?>
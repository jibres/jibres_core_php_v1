<?php
namespace lib\app\log\caller\domain;



class domain_successfullConnected
{

	public static function site($_args = [])
	{
		$result              = [];
		$result['title']     = T_("Domain");
		$result['icon']      = 'flag';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-red';
		$result['txt']       = self::get_msg($_args);
		return $result;
	}




	public static function get_msg($_args = [])
	{
		$my_domain      = a($_args, 'data', 'my_domain');

		$msg = T_("Domain :val is now ready for use.", ['val' => $my_domain]);

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
		$tg_msg .= "#Domain #Business ";

		$tg_msg .= " 🎉 \n";

		$tg_msg .= self::get_msg($_args);

		$tg_msg .= "\n";

		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
<?php
namespace lib\app\log\caller\application;



class application_readyToDownload
{

	public static function site($_args = [])
	{

		$result              = [];
		$result['title']     = T_("Your Application is ready to download");
		$result['icon']      = 'android-1';
		$result['cat']       = T_("Application");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = $msg;
		return $result;

	}

	public static function expire()
	{
		// 1 month
		return date("Y-m-d H:i:s", time() + (60*24*30));
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
		$fileaddr = isset($_args['data']['fileaddr']) ? $_args['data']['fileaddr'] : null;

		$msg = T_("Build application completed");
		$msg .= '<a href="'. $fileaddr. '" download > <b>'. T_("To download it click here"). '</b> </a>';
		// $msg .= T_("This file will be automatically deleted for a few minutes");

		$tg_msg = '';
		$tg_msg .= "#Application\n";
		$tg_msg .= $msg;
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
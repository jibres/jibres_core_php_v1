<?php
namespace lib\app\log\caller\business;



class business_features
{

	public static function site($_args = [])
	{

		$my_name         = isset($_args['data']['my_name']) ? $_args['data']['my_name'] : null;

		$result              = [];

		$result['title']     = T_("New feature payed");

		$result['icon']      = 'money-banknote';
		$result['cat']       = T_("Features");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}




	public static function get_msg($_args = [], $_avatar = false)
	{
		$msg               = '';

		$my_feature_key    = isset($_args['data']['my_feature_key']) ? $_args['data']['my_feature_key'] : null;
		$my_business_id    = isset($_args['data']['my_business_id']) ? $_args['data']['my_business_id'] : null;
		$my_user_id        = isset($_args['data']['my_user_id']) ? $_args['data']['my_user_id'] : null;
		$my_page_url       = isset($_args['data']['my_page_url']) ? $_args['data']['my_page_url'] : null;
		$my_business_title = isset($_args['data']['my_business_title']) ? $_args['data']['my_business_title'] : null;
		$my_price          = isset($_args['data']['my_price']) ? $_args['data']['my_price'] : null;



		$msg .= "\n#$my_feature_key\n";
		$msg .= T_("Feature") . ' '. \lib\features\get::title($my_feature_key). "\n";
		$msg .= T_("Business") . ' '. $my_business_title. "\n";
		$msg .= T_("Price") . ' '. \dash\fit::number($my_price). "\n";
		$msg .= T_("Page Url") . "\n". $my_page_url. "\n";

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
		return false;
	}



	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#Business #New ";

		$tg_msg .= " 🎉 \n";

		$tg_msg .= T_("New business created");

		$tg_msg .= "\n";

		$tg_msg .= self::get_msg($_args, true);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
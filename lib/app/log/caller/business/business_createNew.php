<?php
namespace lib\app\log\caller\business;



class business_createNew
{

	public static function site($_args = [])
	{

		$my_name         = isset($_args['data']['my_name']) ? $_args['data']['my_name'] : null;

		$result              = [];

		$result['title']     = T_("New business created");

		$result['icon']      = 'shop';
		$result['cat']       = T_("Business");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}




	public static function get_msg($_args = [])
	{
		$msg          = '';
		$my_name      = isset($_args['data']['my_name']) ? $_args['data']['my_name'] : null;
		$my_subdomain = isset($_args['data']['my_subdomain']) ? $_args['data']['my_subdomain'] : null;
		$my_owner = isset($_args['data']['my_owner']) ? $_args['data']['my_owner'] : null;

		$msg .= T_("Business title") . ' '. $my_name. "\n";
		$msg .= T_("Business subdomain") . ' '. $my_subdomain. "\n";
		$msg .= T_("Business owner") . ' '. $my_owner. "\n";

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

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
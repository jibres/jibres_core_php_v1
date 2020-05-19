<?php
namespace lib\app\log\caller\domain;



class domain_newRegister
{

	public static function site($_args = [])
	{

		$result              = [];
		$result['title']     = T_("A new domain was registered");
		$result['icon']      = 'heartbeat';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';

		$my_domain       = isset($_args['data']['my_domain']) ? $_args['data']['my_domain'] : null;
		$my_period       = isset($_args['data']['my_period']) ? $_args['data']['my_period'] : null;
		$my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;
		$my_giftusage_id = isset($_args['data']['my_giftusage_id']) ? $_args['data']['my_giftusage_id'] : null;
		$my_finalprice   = isset($_args['data']['my_finalprice']) ? $_args['data']['my_finalprice'] : null;

		$msg = T_("New domain :domain was registered. period :period", ['domain' => $my_domain, 'period' => T_($my_period)]);

		if($my_type === 'renew')
		{
			$msg = T_("Domain :domain was renewed. period :period", ['domain' => $my_domain, 'period' => T_($my_period)]);
		}
		elseif($my_type === 'transfer')
		{

		}


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
		$tg_msg .= "#Domain 🇮🇷 \n";
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
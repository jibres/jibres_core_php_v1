<?php
namespace lib\app\log\caller\domain;



class domain_expireDomainInNextDay
{

	public static function site($_args = [])
	{

		$result              = [];
		$result['title']     = T_("Alert domain expire");
		$result['icon']      = 'heartbeat';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-blue';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';

		$domains_list = isset($_args['data']['domains_list']) ? $_args['data']['domains_list'] : [];
		if(!is_array($domains_list))
		{
			$domains_list = [];
		}

		if(count($domains_list) === 1 && isset($domains_list[0]['domain']))
		{
			$msg = T_("Domain :domain will be expire in next day!", ['domain' => $domains_list[0]['domain']]);
		}
		elseif(count($domains_list) < 10)
		{
			$domain = array_column($domains_list, 'domain');
			$domain = implode(',', $domain);
			$msg = T_("Domain :domain will be expire in next day!", ['domain' => $domain]);
		}
		else
		{
			$msg = T_(":count Domains will be expire in next day!", ['count' => \dash\fit::number(count($domains_list))]);
		}

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
		return false;
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
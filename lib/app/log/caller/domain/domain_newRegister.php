<?php
namespace lib\app\log\caller\domain;



class domain_newRegister
{

	public static function site($_args = [])
	{

		$my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;

		$result              = [];

		$result['title']     = T_("Domain register successfull");

		if($my_type === 'renew')
		{
			$result['title']     = T_("Domain renew successfull");
		}
		elseif($my_type === 'transfer')
		{
			$result['title']     = T_("Domain transfer successfull");
		}

		$result['icon']      = 'flag';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-blue';
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
		$my_nic_credit   = isset($_args['data']['my_nic_credit']) ? $_args['data']['my_nic_credit'] : null;
		$my_user_budget   = isset($_args['data']['my_user_budget']) ? $_args['data']['my_user_budget'] : null;



		$msg = T_("New domain :domain was registered.", ['domain' => $my_domain]);

		if($my_type === 'renew')
		{
			$msg = T_("Domain :domain was renewed.", ['domain' => $my_domain]);
		}
		elseif($my_type === 'transfer')
		{
			$msg = T_("Domain :domain was transferd.", ['domain' => $my_domain]);
		}


		if(intval($my_period) === 12)
		{
			$msg .= PHP_EOL. T_("For 1 year.");

		}
		elseif($my_period === (12*5))
		{
			$msg .= PHP_EOL. T_("For 5 year.");
		}

		if($my_giftusage_id)
		{
			$msg .= PHP_EOL. T_("Used from a gift card.");
		}

		if($my_finalprice)
		{
			$msg .= PHP_EOL. T_("Total payed :val ", ['val' => \dash\fit::number($my_finalprice)]);
		}

		if($my_user_budget)
		{
			$msg .= PHP_EOL. T_("Current user budget :val ", ['val' => \dash\fit::number($my_user_budget)]);
		}


		if(isset($_args['data']['log_user_detail']['fullname']))
		{
			$msg .= ' | '. $_args['data']['log_user_detail']['fullname']. ' ';
		}
		if(isset($_args['data']['log_user_detail']['mobile']) && $_args['data']['log_user_detail']['mobile'])
		{
			$msg .= ' '. \dash\fit::mobile($_args['data']['log_user_detail']['mobile']). ' ';
		}

		if($my_nic_credit)
		{
			$msg .= PHP_EOL. T_("Current nic credit is :val ", ['val' => \dash\fit::number($my_nic_credit)]);
		}

		return $msg;
	}


	public static function send_to()
	{
		return ['supervisor'];
	}

	public static function active_bot()
	{
		return 'JibresDomainBot';
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
		$tg_msg .= "#Domain #IRNIC ";

		$my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;

		if($my_type === 'register')
		{
			$tg_msg .= "#register";
		}
		elseif($my_type === 'renew')
		{
			$tg_msg .= "#renew";
		}
		elseif($my_type === 'transfer')
		{
			$tg_msg .= "#transfer";
		}

		$tg_msg .= " 🇮🇷 \n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
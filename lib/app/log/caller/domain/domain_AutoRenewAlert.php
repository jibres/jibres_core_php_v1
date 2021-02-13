<?php
namespace lib\app\log\caller\domain;



class domain_AutoRenewAlert
{

	public static function site($_args = [])
	{
		$result              = [];
		$result['title']     = T_("Domain Auto renew alert");
		$result['icon']      = 'flag';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-red';
		$result['txt']       = self::get_msg($_args);
		return $result;
	}




	public static function get_msg($_args = [])
	{


		$my_domain      = a($_args, 'data', 'my_domain');
		$my_domain_id   = a($_args, 'data', 'my_domain_id');
		$my_expredate   = a($_args, 'data', 'my_expredate');
		$my_mode        = a($_args, 'data', 'my_mode');
		$my_budget      = a($_args, 'data', 'my_budget');
		$my_price       = a($_args, 'data', 'my_price');
		$my_renew_is_ok = a($_args, 'data', 'my_renew_is_ok');
		$my_status      = a($_args, 'data', 'my_status');
		$my_action      = a($_args, 'data', 'my_action');

		if($my_action === 'exec')
		{
			// execute renew action
			switch ($my_status)
			{
				case 'low_budget':
					$msg = T_("We try to renew domain :val But your budget less than domain renew price.", ['val' => $my_domain]);
					break;

				case 'failed':
					$msg = T_("We try to renew domain :val But renew is failed!", ['val' => $my_domain]);
					break;

				case 'ok':
					$msg = T_("Domain :val successfully renewed. Have a good time", ['val' => $my_domain]);
					break;

				case 'unknown':
				default:
					$msg = T_("We try to renew domain :val But renew is not complete!", ['val' => $my_domain]);
					break;
			}
		}
		else
		{
			// only notif
			if($my_renew_is_ok)
			{
				$msg = T_("Domain :val will be renewed at tomorrow.", ['val' => $my_domain]);
			}
			else
			{
				$msg = T_("Domain :val will be renewed at tomorrow. But your balance is low.", ['val' => $my_domain]);
			}
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
		$tg_msg .= "#Domain #AutoRenew ";

		$tg_msg .= " 🔃 \n";

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
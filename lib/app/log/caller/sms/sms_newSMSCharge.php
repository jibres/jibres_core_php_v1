<?php
namespace lib\app\log\caller\sms;


class sms_newSMSCharge
{


	public static function site($_args = [])
	{
		$result = [];

		$result['title'] = T_("New sms charge :)");

		$result['icon']      = 'envelope';
		$result['cat']       = T_("SMS");
		$result['iconClass'] = 'text-blue-600';
		$result['txt']       = self::get_msg($_args);

		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';

		$store_id = a($_args, 'data', 'myData', 'store_id');
		$amount   = a($_args, 'data', 'myData', 'amount');
		$balance  = a($_args, 'data', 'myData', 'balance');

		$msg .= '#NewSMSCharge ';
		if($store_id)
		{
			$store_detail = \lib\app\store\get::data_by_id($store_id);
			$msg          .= T_("Business") . ': ' . a($store_detail, 'title');
		}

		if($amount > 0)
		{

			$msg .= ' ' . PHP_EOL;
			$msg .= T_("Increase the charge to the amount") . ' ' . \dash\fit::number($amount) . ' ' . \lib\currency::jibres_currency(true);
		}
		else
		{

			$msg .= ' ' . PHP_EOL;
			$msg .= T_("Reduce the charge to the amount") . ' ' . \dash\fit::number($amount) . ' ' . \lib\currency::jibres_currency(true);
		}

		$msg .= ' ' . PHP_EOL;
		$msg .= T_("Current balance") . ': ' . \dash\fit::number($balance) . ' ' . \lib\currency::jibres_currency(true);


		return $msg;
	}


	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60 * 60 * 24 * 3));
	}


	public static function is_notif()
	{
		return true;
	}


	public static function send_to()
	{
		return ['supervisor'];
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
		$tg_msg .= "#newSMSCharge  ";

		$tg_msg .= "📨 \n";

		$tg_msg .= self::get_msg($_args);

		$tg            = [];
		$tg['chat_id'] = $_chat_id;
		$tg['text']    = $tg_msg;

		return $tg;

	}

}

?>
<?php
namespace dash\app\log\caller\transaction;


class transaction_newPaySuccessfull
{

	public static function site($_args = [])
	{

		// $my_type         = isset($_args['data']['my_type']) ? $_args['data']['my_type'] : null;

		$result              = [];

		$result['title']     = T_("Successful payment");

		$result['icon']      = 'money-banknote';
		$result['cat']       = T_("Payment");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		$result['txt'] .= '<a class="link btn" href="'. \dash\url::kingdom(). '/crm/transactions'. '">'. T_("Transactions list"). '</a>';
		return $result;

	}


	public static function get_msg($_args = [])
	{

		$msg = '';
		$amount = null;
		if(isset($_args['data']['my_detail']['plus']))
		{
			$amount = \dash\fit::number($_args['data']['my_detail']['plus']);
		}

		$currency = null;
		if(isset($_args['data']['my_detail']['currecy_name']))
		{
			$currency = $_args['data']['my_detail']['currecy_name'];
		}

		$title = null;
		if(isset($_args['data']['my_detail']['title']))
		{
			$title = $_args['data']['my_detail']['title'];
		}

		$msg .= T_(":amount :currency paid. Description :title", ['amount' => $amount, 'currency' => $currency, 'title' => $title]);

		return $msg;
	}


	public static function send_to()
	{
		return ['supervisor', 'admin'];
	}


	public static function expire()
	{
		// 3 days
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
		$tg_msg .= "#newPayment ";

		$tg_msg .= " 💰 \n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>
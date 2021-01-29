<?php
namespace dash\app\log\caller\transaction;


class transaction_addTransactionManualy
{

	public static function site($_args = [])
	{


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
		if(isset($_args['data']['log_user_detail']))
		{
			$msg .= ' '. T_("Operator");

			if(isset($_args['data']['log_user_detail']['fullname']))
			{
				$msg .= ' '. $_args['data']['log_user_detail']['fullname']. ' ';
			}
			if(isset($_args['data']['log_user_detail']['mobile']) && $_args['data']['log_user_detail']['mobile'])
			{
				$msg .= ' '. \dash\fit::mobile($_args['data']['log_user_detail']['mobile']). ' ';
			}
			$msg .= "\n";

		}

		$amount = null;
		if(isset($_args['data']['my_amount']))
		{
			$amount = \dash\fit::number($_args['data']['my_amount']);
		}

		$type = null;
		if(isset($_args['data']['my_type']))
		{
			$type = \dash\fit::number($_args['data']['my_type']);
		}

		if($type === 'plus')
		{
			$type = T_("Increase account recharge");
		}
		elseif($type === 'minus')
		{
			$type = T_("Reduce account recharge");
		}

		$currency = null;
		if(isset($_args['data']['my_currecy']))
		{
			$currency = $_args['data']['my_currecy'];
			$currency = \lib\currency::name($currency);
		}

		$title = null;
		if(isset($_args['data']['my_title']))
		{
			$title = $_args['data']['my_title'];
		}

		$msg .= $type. ' ';
		$msg .= $amount. ' ';
		$msg .= $currency. ' ';
		$msg .= T_("Description"). ' ';
		$msg .= $title. ' ';


		$for_user = null;
		if(isset($_args['data']['my_for_user_name']))
		{
			$for_user = $_args['data']['my_for_user_name'];
			$msg .= T_("For user"). ' ';
			$msg .= $for_user. ' ';
		}

		$for_mobile = null;
		if(isset($_args['data']['my_for_user_mobile']))
		{
			$for_mobile = $_args['data']['my_for_user_mobile'];
			$msg .= T_("Mobile"). ' ';
			$msg .= \dash\fit::mobile($for_mobile). ' ';
		}


		return $msg;
	}


	public static function send_to()
	{
		return ['supervisor', 'admin'];
	}

	public static function save_user_detail()
	{
		return true;
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
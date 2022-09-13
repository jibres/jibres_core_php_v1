<?php
namespace lib\app\log\caller\plan;


class plan_cancelPlan
{


	public static function site($_args = [])
	{
		$result = [];

		$result['title'] = T_("Plan canceled :(");

		$result['icon']      = 'tree';
		$result['cat']       = T_("Plan");
		$result['iconClass'] = 'text-red-600';
		$result['txt']       = self::get_msg($_args);

		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg       = '';
		$plan      = isset($_args['data']['myData']['plan']) ? $_args['data']['myData']['plan'] : null;
		$store_id  = isset($_args['data']['myData']['store_id']) ? $_args['data']['myData']['store_id'] : null;
		$price     = a($_args, 'data', 'myData', 'price');
		$guarantee = a($_args, 'data', 'myData', 'guarantee');

		$msg .= '#CancelPlan ';
		if($store_id)
		{
			$store_detail = \lib\app\store\get::data_by_id($store_id);
			$msg          .= T_("Business") . ': ' . a($store_detail, 'title');
		}

		$msg .= ' ' . PHP_EOL;
		$msg .= T_("Plan") . ': ' . T_(ucfirst(strval($plan)));
		$msg .= ' ' . PHP_EOL;
		$msg .= T_("Refund price") . ': ' . \dash\fit::number($price) . ' ' . \lib\currency::unit();

		if($guarantee)
		{
			$msg .= ' ' . PHP_EOL;
			$msg .= T_("Include guarantee");
		}

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
		$tg_msg .= "#CancelPlan  ";

		$tg_msg .= "🪵 \n";

		$tg_msg .= self::get_msg($_args);

		$tg            = [];
		$tg['chat_id'] = $_chat_id;
		$tg['text']    = $tg_msg;

		return $tg;

	}

}

?>
<?php
namespace lib\app\log\caller\plan;


class plan_newPlanActivate
{


	public static function site($_args = [])
	{
		$result = [];

		$result['title'] = T_("New plan activated :)");

		$result['icon']      = 'tree';
		$result['cat']       = T_("Plan");
		$result['iconClass'] = 'text-green-600';
		$result['txt']       = self::get_msg($_args);

		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg        = '';
		$plan       = isset($_args['data']['myData']['plan']) ? $_args['data']['myData']['plan'] : null;
		$store_id   = a($_args, 'data', 'myData', 'store_id');
		$startdate  = a($_args, 'data', 'myData', 'startdate');
		$expirydate = a($_args, 'data', 'myData', 'expirydate');
		$action     = a($_args, 'data', 'myData', 'action');
		$periodtype = a($_args, 'data', 'myData', 'periodtype');
		$setby      = a($_args, 'data', 'myData', 'setby');
		$days       = a($_args, 'data', 'myData', 'days');
		// $realdays   = a($_args, 'data', 'myData', 'realdays');
		$finalprice = a($_args, 'data', 'myData', 'finalprice');

		$msg .= '#NewPlan ';
		if($store_id)
		{
			$store_detail = \lib\app\store\get::data_by_id($store_id);
			$msg          .= T_("Business") . ': ' . a($store_detail, 'title');
		}

		$msg .= ' '. PHP_EOL;
		$msg .= T_("Plan") . ': ' . T_(ucfirst(strval($plan)));
		$msg .= ' '. PHP_EOL;
		$msg .= T_("Start date") . ': ' . \dash\fit::date($startdate);
		$msg .= ' '. PHP_EOL;
		$msg .= T_("Expire date") . ': ' . \dash\fit::date($expirydate);
		$msg .= ' '. PHP_EOL;
		$msg .= T_("Action") . ': ' . T_(ucfirst(strval($action)));
		$msg .= ' '. PHP_EOL;
		$msg .= T_("Period") . ': ' . T_(ucfirst(strval($periodtype)));
		$msg .= ' '. PHP_EOL;
		$msg .= T_("Set by") . ': ' . T_(ucfirst(strval($setby)));
		$msg .= ' '. PHP_EOL;
		$msg .= T_("Plan day") . ': ' . \dash\fit::number($days);
		$msg .= ' '. PHP_EOL;
		$msg .= T_("Price") . ': ' . \dash\fit::number($finalprice);

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
		$tg_msg .= "#newPlan  ";

		$tg_msg .= "🌳 \n";

		$tg_msg .= self::get_msg($_args);

		$tg            = [];
		$tg['chat_id'] = $_chat_id;
		$tg['text']    = $tg_msg;

		return $tg;

	}

}

?>
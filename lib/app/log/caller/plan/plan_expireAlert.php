<?php
namespace lib\app\log\caller\plan;


class plan_expireAlert
{


	public static function site($_args = [])
	{
		$result = [];

		$result['title'] = T_("Plan expiration warning");

		$result['icon']      = 'tree';
		$result['cat']       = T_("Plan");
		$result['iconClass'] = 'text-green-600';
		$result['txt']       = self::get_msg($_args);

		return $result;

	}


	public static function get_msg($_args = [])
	{
		$msg = '';

		$store_id      = isset($_args['data']['myData']['store_id']) ? $_args['data']['myData']['store_id'] : null;
		$expiretitle   = isset($_args['data']['myData']['expiretitle']) ? $_args['data']['myData']['expiretitle'] : null;
		$businessTitle = null;
		if($store_id)
		{
			$store_detail  = \lib\app\store\get::data_by_id($store_id);
			$businessTitle = a($store_detail, 'title');
		}
		$msg .= T_("Your current plan at :business Business will expire in :val. ", [
			'business' => $businessTitle, 'val' => $expiretitle,
		]);
		$msg .= "\n";
		$msg .= T_("Please purchase a new plan");
		$msg .= "\n";
		$msg .= ' ' . T_("Jibres; Sell and enjoy");

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


	public static function telegram()
	{
		return true;
	}


	public static function sms()
	{
		return true;
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
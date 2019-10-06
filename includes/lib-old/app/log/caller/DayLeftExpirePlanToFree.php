<?php
namespace lib\app\log\caller;

class DayLeftExpirePlanToFree
{
	public static function site($_args = [])
	{
		$storename   = isset($_args['data']['storename']) ? $_args['data']['storename'] : null;
		$currentplan = isset($_args['data']['currentplan']) ? $_args['data']['currentplan'] : null;
		$dayleft     = isset($_args['data']['dayleft']) ? $_args['data']['dayleft'] : null;

		$result              = [];
		$result['title']     = T_("Expire plan");
		$result['icon']      = 'heartbeat';
		$result['cat']       = T_("Plan");
		$result['iconClass'] = 'fc-blue';


		$excerpt = T_(":day day left to expir plan of :storename", ['storename' => $storename, 'day' => \dash\utility\human::fitNumber($dayleft)]);
		$excerpt .= ' ';
		$excerpt .=	'<a href="'.\dash\url::kingdom(). '/a/setting/plan">';
		$excerpt .= T_("Upgrade");
		$excerpt .= ' ';
		$excerpt .= '</a>';

		$result['txt'] = $excerpt;

		return $result;
	}


	public static function is_notif()
	{
		return true;
	}

	public static function expire()
	{
		return date("Y-m-d H:i:s", strtotime("+1 days"));
	}

	public static function telegram()
	{
		return true;
	}

	public static function telegram_text($_args, $_chat_id)
	{

		$tg_msg = '';
		$tg_msg .= "#Plan\n";
		$tg_msg .= T_("One day left to your store plan expired");
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;
		return $tg;
	}
}
?>
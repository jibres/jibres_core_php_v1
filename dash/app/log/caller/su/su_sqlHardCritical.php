<?php
namespace dash\app\log\caller\su;

class su_sqlHardCritical
{
	public static function site($_args = [])
	{

		$excerpt = T_("We have a number of requests from the database that have taken a long time");

		$result              = [];
		$result['title']     = T_("Critical query!");
		$result['icon']      = 'bug-2';
		$result['cat']       = T_("Query");
		$result['iconClass'] = 'fc-red';

		$excerpt .= ' ';
		$excerpt .=	'<a class="badge warn" href="'.\dash\url::kingdom(). '/su/log">';
		$excerpt .= T_("Show");
		$excerpt .= '</a>';


		$result['excerpt']   = $excerpt;

		return $result;
	}


	public static function send_to()
	{
		return ['supervisor'];
	}

	public static function is_notif()
	{
		return true;
	}

	public static function telegram()
	{
		return true;
	}

	public static function expire()
	{
		return date("Y-m-d H:i:s", strtotime("+30 days"));
	}



	public static function telegram_text($_args, $_chat_id)
	{
		$mymsg = isset($_args['mymsg']) ? $_args['mymsg'] : null;

		$tg_msg = '';
		$tg_msg .= "🦠 #CRITICAL_QUERY\n";
		$tg_msg .= T_("We have a number of requests from the database that have taken a long time");

		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;
		$tg['reply_markup'] = false;

		// $tg = json_encode($tg, JSON_UNESCAPED_UNICODE);

		return $tg;
	}
}
?>
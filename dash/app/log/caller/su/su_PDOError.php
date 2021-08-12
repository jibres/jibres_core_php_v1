<?php
namespace dash\app\log\caller\su;

class su_PDOError
{
	public static function site($_args = [])
	{

		$excerpt = T_("PDO have error!!");
		$mymsg = isset($_args['mymsg']) ? $_args['mymsg'] : null;

		$result              = [];
		$result['title']     = T_("PDO error!");
		$result['icon']      = 'crosshairs';
		$result['cat']       = T_("Bug");
		$result['iconClass'] = 'fc-hot';

		$excerpt .= ' ';
		$excerpt .=	'<a class="badge warn" href="'.\dash\url::kingdom(). '/sudo/log">';
		$excerpt .= T_("Show");
		$excerpt .= '</a>';

		$excerpt .= self::get_domain_name($_args);


		$result['excerpt']   = $excerpt;

		return $result;
	}

	private static function get_domain_name($_args)
	{
		if(isset($_args['data']['my_domain']))
		{
			return ' '. $_args['data']['my_domain'];
		}
		return null;

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
		$tg_msg .= "⁉️ #PDO_ERROR\n";

		$code = isset($_args['code']) ? $_args['code'] : null;
		if($code)
		{
			$code = \dash\fit::date_human(date("Y-m-d H:i:s", $code));
			// $tg_msg .= "\n";
			$tg_msg .= $code;
			// $tg_msg .= "\n";
		}
		$tg_msg .= "\n";
		$tg_msg .= self::get_domain_name($_args);
		$tg_msg .= "\n";


		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), 'shortDate');

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;
		$tg['reply_markup'] = false;

		// $tg = json_encode($tg, JSON_UNESCAPED_UNICODE);

		return $tg;
	}
}
?>
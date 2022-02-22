<?php
namespace dash\app\log\caller\su;

class su_cdnUpdate
{
	public static function site($_args = [])
	{
		$is_me = \dash\app\log\msg::is_me($_args);
		if(!$is_me)
		{
			$excerpt  = '<span class="fc-green">'.\dash\app\log\msg::displayname($_args). '</span> ';
			$excerpt .= ' ';
			$excerpt .= T_("updated");
		}
		else
		{
			$excerpt = T_("You updated");
		}

		$excerpt .= self::get_domain_name($_args);



		$result              = [];
		$result['title']     = T_("CDN");
		$result['icon']      = 'git-square';
		$result['cat']       = T_("System");
		$result['iconClass'] = 'fc-blue';
		$result['excerpt']   = $excerpt;
		return $result;
	}


	public static function active_bot()
	{
		return 'jibres_bot';
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

	private static function get_domain_name($_args)
	{
		if(isset($_args['data']['my_domain']))
		{
			return ' '. $_args['data']['my_domain'];
		}
		return null;

	}

	public static function telegram_text($_args, $_chat_id)
	{
		$load = \dash\app\log\support_tools::load($_args);
		$plus = \dash\app\log\support_tools::plus($_args);

		$code = isset($_args['code']) ? $_args['code'] : null;

		$tg_msg = '';
		$tg_msg .= "🥊 #CDNUpdate";
		$tg_msg .= " ";
		$tg_msg .= "👨‍💻 ".\dash\log::from_name();
		$tg_msg .= "\n";
		$tg_msg .= self::get_domain_name($_args);
		$tg_msg .= "\n";

		$tg_msg .= "⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), 'shortDate');

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;
		$tg['reply_markup'] = false;

		// $tg = json_encode($tg, JSON_UNESCAPED_UNICODE);

		return $tg;
	}
}
?>
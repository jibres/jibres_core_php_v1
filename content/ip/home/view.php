<?php
namespace content\ip\home;

class view
{
	public static function config()
	{
		\dash\data::action_link(\dash\url::here());
		\dash\data::action_text(T_('Dashboard'));

		$myIp = \dash\server::ip();
		// fill ip from child
		if(\dash\url::child())
		{
			$myIp = \dash\url::child();

			// only check limit if try to find other ip
			self::check_limit();
		}

		if(\dash\validate::ip($myIp, false))
		{
			// get ip data
			\dash\data::ip(\dash\utility\ipLocation::get($myIp));

			// get ip detail from jibres data
			if(\dash\permission::supervisor())
			{
				\dash\data::ipStatus(\dash\waf\ip::fetch($myIp));
			}

			\dash\face::title(T_("IP"). " ". $myIp);

			\dash\data::ipDetail(\dash\utility\ip::fetch($myIp));

			\dash\face::cover(\dash\url::cdn(). '/img/flags/png100px/'. \dash\data::ip_flag(). '.png');

			$desc = T_(\dash\data::ip_country());
			$desc .= ' / '.  T_("Province"). ' '. T_(ucwords(\dash\data::ip_state()));
			$desc .= ' / '.  T_("City"). ' '. T_(ucwords(\dash\data::ip_city()));
			$desc .= ' / '.  T_("ISP"). ' '. T_(ucwords(\dash\data::ip_isp()));
			$desc .= ' / '.  T_(ucwords(\dash\data::ip_latitude()));
			$desc .= '-'. T_(ucwords(\dash\data::ip_longitude()));

			$desc .= ' ';
			\dash\face::desc($desc);
			// ip is okay
		}
		else
		{
			// invalid ip
			\dash\header::status(400);
		}
	}


	private static function check_limit()
	{

		$check_log           = [];
		$check_log['caller'] = 'ip_fetch_request';

		$this_hour           = date("Y-m-d H:i:s", (time() - (60*60)));

		if(\dash\user::id())
		{
			$check_log['from']   = \dash\user::id();

			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);

			if($get_count_log > 50)
			{
				\dash\waf\ip::isolateIP(2, 'ip_fetch_request per user');
			}
		}
		else
		{
			$check_log['ip_id']   = \dash\utility\ip::id();

			$get_count_log = \dash\db\logs::count_where_date($check_log, $this_hour);

			if($get_count_log > 50)
			{
				\dash\waf\ip::isolateIP(2, 'ip_fetch_request per ip');
			}
		}

		\dash\log::set('ip_fetch_request');
	}
}
?>
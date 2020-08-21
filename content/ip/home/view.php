<?php
namespace content\ip\home;

class view
{
	public static function config()
	{
		\dash\data::action_link(\dash\url::here());
		\dash\data::action_text(T_('Dashboard'));

		$myIp = \dash\server::ip();

		if(\dash\url::child())
		{
			$myIp = \dash\url::child();
			if(\dash\validate::ip($myIp, false))
			{
				// get ip data
				\dash\data::ip(\dash\utility\ipLocation::get($myIp));
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


	}
}
?>
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
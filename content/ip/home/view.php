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
				// ip is okay
			}
			else
			{
				// invalid ip
				\dash\header::status(400);
			}
		}
		\dash\data::ip(\dash\utility\ipLocation::get($myIp));

		\dash\face::title(T_("IP"). " ". $myIp);
	}
}
?>
<?php
namespace content_pardakhtyar\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Dashboard"));
		\dash\data::page_desc(' ');
		\dash\data::page_pictogram('trophy');
		\dash\data::page_special(true);

		if(\dash\request::get('transfer'))
		{
			\lib\pardakhtyar\app\shaparak\transfer::run();
		}
	}
}
?>
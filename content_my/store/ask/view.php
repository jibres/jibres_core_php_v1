<?php
namespace content_my\store\ask;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Help Jibres work better"));

		$polls = \lib\app\store\polls::all();
		\dash\data::polls($polls);

		\dash\data::userToggleSidebar(false);
	}
}
?>

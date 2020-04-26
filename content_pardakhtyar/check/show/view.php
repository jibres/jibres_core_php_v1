<?php
namespace content_pardakhtyar\check\show;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Check"));
		\dash\data::page_desc('Check request detail');
		\dash\data::page_pictogram('question');

		$data = \lib\pardakhtyar\app\check::get(\dash\request::get('id'));
		\dash\notif::api($data);

	}
}
?>
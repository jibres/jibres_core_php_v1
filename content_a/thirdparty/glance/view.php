<?php
namespace content_a\thirdparty\glance;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('The user at a glance'));
		\dash\data::page_desc(T_('Check all detail of user in dashboard just in a second.'));
		\dash\data::page_pictogram('monitor');

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

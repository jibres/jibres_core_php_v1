<?php
namespace content_a\customer\glance;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('The user at a glance'));
		\dash\data::page_desc(T_('Check all detail of user in dashboard just in a second.'));
		\dash\data::page_pictogram('broadcast');

		\content_a\customer\load::fixTitle();

	}
}
?>

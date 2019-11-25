<?php
namespace content_a\customer\profile;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('User profile'));
		\dash\data::page_desc(T_('Add and check note of user and access to other part of profile detail.'));
		\dash\data::page_pictogram('pencil-square-o');

		$log = \lib\app\customer\comment::list(\dash\request::get('id'));
		\dash\data::dataTable($log);

		\content_a\customer\load::fixTitle();
	}
}
?>

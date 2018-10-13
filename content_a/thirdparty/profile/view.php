<?php
namespace content_a\thirdparty\profile;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('User profile'));
		\dash\data::page_desc(T_('Add and check note of user and access to other part of profile detail.'));
		\dash\data::page_pictogram('user');

		$log = \lib\app\thirdparty\comment::list(\dash\request::get('id'));
		$log = array_reverse($log);
		\dash\data::logDetail($log);

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

<?php
namespace content_a\thirdparty\tag;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Tag for user'));
		\dash\data::page_desc(T_('you can edit general detail of thirdparty'));

		$log = \lib\app\thirdparty\comment::list(\dash\request::get('id'));
		$log = array_reverse($log);
		\dash\data::logDetail($log);
	}
}
?>

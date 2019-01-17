<?php
namespace content_a\thirdparty\comment;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Notes'));
		\dash\data::page_desc(T_('Add some note for user to archive them and read later.'));
		\dash\data::page_pictogram('chat-alt-fill');

		$log = \lib\app\thirdparty\comment::list(\dash\request::get('id'));

		\dash\data::dataTable($log);


		\content_a\thirdparty\load::fixTitle();
	}
}
?>

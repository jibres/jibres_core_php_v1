<?php
namespace content_a\thirdparty\log;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Glance user detail'));
		\dash\data::page_desc(T_('you can edit general detail of thirdparty'));

	}
}
?>

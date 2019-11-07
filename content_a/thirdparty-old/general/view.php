<?php
namespace content_a\thirdparty\general;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Edit general information'));
		\dash\data::page_desc(T_('Edit general detail of this thirdparty.'));
		\dash\data::page_pictogram('user');

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

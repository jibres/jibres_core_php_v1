<?php
namespace content_a\customer\tag;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('Tag for user'));
		\dash\data::page_desc(T_('you can edit general detail of customer'));

	}
}
?>

<?php
namespace content_a\customer\general;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('Edit general information'));
		\dash\data::page_desc(T_('Edit general detail of this customer.'));
		\dash\data::page_pictogram('user');

		\content_a\customer\load::fixTitle();
	}
}
?>

<?php
namespace content_a\customer\bought;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('Customer bought'));
		\dash\data::page_desc(T_('Buy list of this user as customer in store.'));
		\dash\data::page_pictogram('basket');

		\content_a\customer\load::fixTitle();
	}
}
?>

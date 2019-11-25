<?php
namespace content_a\customer\sold;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('Supplier sold'));
		\dash\data::page_desc(T_('Total purchased items from this supplier.'));
		\dash\data::page_pictogram('archive');

		\content_a\customer\load::fixTitle();
	}
}
?>

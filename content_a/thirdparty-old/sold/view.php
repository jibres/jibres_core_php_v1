<?php
namespace content_a\thirdparty\sold;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Supplier sold'));
		\dash\data::page_desc(T_('Total purchased items from this supplier.'));
		\dash\data::page_pictogram('archive');

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

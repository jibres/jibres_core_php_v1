<?php
namespace content_a\thirdparty\factor;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Seller factors'));
		\dash\data::page_desc(T_('List of factors of this user as seller.'));
		\dash\data::page_pictogram('folder-1');

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

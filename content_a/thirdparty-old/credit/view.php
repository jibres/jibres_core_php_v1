<?php
namespace content_a\thirdparty\credit;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Credit'));
		\dash\data::page_desc(T_('Check and increase or decrease credit of user.'));
		\dash\data::page_pictogram('umbrella');

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

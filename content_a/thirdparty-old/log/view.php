<?php
namespace content_a\thirdparty\log;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Logs'));
		\dash\data::page_desc(T_('Monitor user logs and actions in your store'));
		\dash\data::page_pictogram('load-a');


		\content_a\thirdparty\load::fixTitle();
	}
}
?>

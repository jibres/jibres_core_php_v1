<?php
namespace content_a\thirdparty\avatar;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Avatar'));
		\dash\data::page_desc(T_('Allow to set and change avatar of thirdparty'));
		\dash\data::page_pictogram('user-3');

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

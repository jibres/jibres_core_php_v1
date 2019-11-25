<?php
namespace content_a\customer\avatar;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('Avatar'));
		\dash\data::page_desc(T_('Allow to set and change avatar of customer'));
		\dash\data::page_pictogram('user-3');

		\content_a\customer\load::fixTitle();
	}
}
?>

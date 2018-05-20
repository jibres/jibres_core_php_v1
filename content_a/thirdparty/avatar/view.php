<?php
namespace content_a\thirdparty\avatar;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyEdit');

		\content_a\thirdparty\load::memberDetail();

		\dash\data::page_title(T_('Edit avatar'). \dash\data::page_title());
		\dash\data::page_desc(T_('Allow to set and change avatar of thirdparty'));
	}
}
?>

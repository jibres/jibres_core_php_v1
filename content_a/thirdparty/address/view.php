<?php
namespace content_a\thirdparty\address;


class view
{
	public static function config()
	{
		\content_a\thirdparty\edit\load::memberDetail();

		\dash\data::page_title(T_('Edit address'). \dash\data::page_title());
		\dash\data::page_desc(T_('set current location and full address'));
	}
}
?>

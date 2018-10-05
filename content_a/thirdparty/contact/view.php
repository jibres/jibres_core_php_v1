<?php
namespace content_a\thirdparty\contact;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyEdit');
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Edit contact information'). \dash\data::page_title());
		\dash\data::page_desc(T_('Change mobile number of thirdparty and parents, email and tel of home'));
	}
}
?>

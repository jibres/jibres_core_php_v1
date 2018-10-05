<?php
namespace content_a\thirdparty\general;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyEdit');
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Edit general information'). \dash\data::page_title());
		\dash\data::page_desc(T_('you can edit general detail of thirdparty'));

		if(\dash\permission::check("aThirdPartyPermissionChange"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup(array_keys($perm_list));
		}
	}
}
?>

<?php
namespace content_a\thirdparty\manage;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyGlance');
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Glance user detail'));
		\dash\data::page_desc(T_('you can edit general detail of thirdparty'));

		if(\dash\permission::check("mExpertPermissionChange"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup($perm_list);
		}

	}
}
?>

<?php
namespace content_a\thirdparty\manage;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Manage user'));
		\dash\data::page_desc(T_('Control user permission depending on type of thirdparty and change status of them.'));
		\dash\data::page_pictogram('power-off');


		if(\dash\permission::check("thirdpartyPermissionEdit"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup($perm_list);
		}

		\content_a\thirdparty\load::fixTitle();
	}
}
?>

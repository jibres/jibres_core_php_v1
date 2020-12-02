<?php
namespace content_crm\member\permission;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		if(\dash\permission::check("cpUsersPermission"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup($perm_list);
		}


		\dash\face::title(T_('Employee permission'));
	}
}
?>
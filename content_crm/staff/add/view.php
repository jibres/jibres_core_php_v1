<?php
namespace content_crm\member\add;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Add New Customers'));

		\dash\data::back_text(T_('Customers'));
		\dash\data::back_link(\dash\url::this());

		if(\dash\permission::check("crmPermissionManagement"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup($perm_list);
		}


	}
}
?>
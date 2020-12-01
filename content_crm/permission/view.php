<?php
namespace content_crm\permission;


class view
{
	public static function config()
	{
		\dash\permission::access('cpPermissionView');

		\dash\face::title(T_("Permissions"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('Back'));

		\dash\data::action_link(\dash\url::this().'/add');
		\dash\data::action_icon('plus');
		\dash\data::action_text(T_('Add new permission'));

		\dash\data::listEngine_start(true);

		$listPermission = \dash\app\permission\get::list();

		\dash\data::dataTable($listPermission);




	}
}
?>
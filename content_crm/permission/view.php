<?php
namespace content_crm\permission;


class view
{
	public static function config()
	{
		\dash\permission::access('cpPermissionView');

		\dash\face::title(T_("Permissions"));

		\dash\data::action_link(\dash\url::this().'/add');
		\dash\data::action_text(T_('Add new permission'));

		\dash\data::perm_list(\dash\permission::categorize_list());
		\dash\data::perm_group(\dash\permission::groups());
		\dash\data::perm_groupPos(\dash\permission::groups(true));
		\dash\data::perm_usercount(\dash\permission::usercount());


	}
}
?>
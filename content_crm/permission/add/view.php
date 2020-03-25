<?php
namespace content_crm\permission\add;


class view
{
	public static function config()
	{
		\dash\permission::access('cpPermissionAdd');

		\dash\face::title(T_("Add new permissions"));

		\dash\data::action_link(\dash\url::this());
		\dash\data::action_text(T_('Back to list of permissions'));



		\dash\data::perm_list(\dash\permission::categorize_list());
		\dash\data::perm_group(\dash\permission::groups());

		if(\dash\request::get('id'))
		{
			\dash\permission::access('cpPermissionEdit');

			$id = \dash\request::get('id');
			$load_permission = \dash\permission::load_permission($id);

			if(!$load_permission)
			{
				\dash\header::status(404, T_("Invalid permission id"));
			}

			\dash\face::title(T_("Edit permission :name" , ['name' => $load_permission['title']]));

			\dash\data::perm_load($load_permission);
		}
	}
}
?>
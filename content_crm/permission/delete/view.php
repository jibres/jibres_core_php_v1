<?php
namespace content_crm\permission\delete;


class view
{
	public static function config()
	{
		\dash\permission::access('cpPermissionDelete');

		\dash\face::title(T_("Delete a permissions"));

		\dash\data::action_link(\dash\url::this());
		\dash\data::action_text(T_('Back to list of permissions'));

		if(\dash\request::get('id'))
		{
			$id = \dash\request::get('id');
			$load_permission = \dash\permission::load_permission($id);

			if(!$load_permission)
			{
				\dash\header::status(404, T_("Invalid permission id"));
			}
			\dash\data::perm_load($load_permission);

			\dash\face::title(T_("Edit permission :name" , ['name' => $load_permission['title']]));
		}
		else
		{
			\dash\header::status(404, T_("Id not set"));
		}
	}
}
?>
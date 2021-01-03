<?php
namespace content_crm\member\permission;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		if(\dash\permission::check("crmPermissionManagement"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup($perm_list);
		}

		$user_id = \dash\coding::decode(\dash\request::get('id'));

		\dash\data::UserApiKey(\dash\app\user_auth::get_apikey($user_id, 'api'));


		\dash\face::title(T_('Employee permission'));
	}
}
?>
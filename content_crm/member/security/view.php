<?php
namespace content_crm\member\security;


class view
{

	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('Edit user security'));

		\dash\data::action_link(\dash\url::this());
		\dash\data::action_text(T_('Back to dashbaord'));

		if(\dash\permission::check("cpUsersPermission"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup($perm_list);
		}

		$chatid_list = \dash\db\user_telegram::get(['user_id' => \dash\coding::decode(\dash\request::get('id'))]);

		\dash\data::chatIdList($chatid_list);


		$androidList = \dash\db\user_android::get(['user_id' => \dash\coding::decode(\dash\request::get('id'))]);

		\dash\data::androidList($androidList);

		$user_id = \dash\coding::decode(\dash\request::get('id'));

		$list    = \dash\login::get_active_sessions($user_id);

		\dash\data::sessionsList($list);

	}
}
?>
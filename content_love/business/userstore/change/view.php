<?php
namespace content_love\business\userstore\change;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Change user store"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$storeDetail = \lib\app\store\get::by_id(\dash\data::dataRow_store_id());
		$userDetail = \dash\app\user::get(\dash\coding::encode(\dash\data::dataRow_user_id()));
		\dash\data::storeDetail($storeDetail);
		\dash\data::userDetail($userDetail);
	}
}
?>

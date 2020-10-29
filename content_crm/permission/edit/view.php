<?php
namespace content_crm\permission\edit;


class view
{
	public static function config()
	{
		\dash\permission::access('cpPermissionAdd');

		\dash\face::title(T_("Edit permissions"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Back'));

		\dash\face::btnSetting(\dash\url::this(). '/setting?id='. \dash\request::get('id'));

		$savedPerm = \dash\data::dataRow_value();
		if(!is_array($savedPerm))
		{
			$savedPerm = [];
		}

		\dash\data::savedPerm($savedPerm);

		$permissionList = \dash\permission::categorize_list();
		\dash\data::permissionList($permissionList);

	}
}
?>
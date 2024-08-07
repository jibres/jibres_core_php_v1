<?php
namespace content_crm\permission\setting;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Edit permissions"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Back'));

		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));
		\dash\data::back_text(T_('Back'));


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
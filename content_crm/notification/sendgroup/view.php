<?php
namespace content_crm\notification\sendgroup;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Group sending notification"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Notification'));


		$group = \dash\app\user\group::list();
		\dash\data::groupList($group);


	}
}
?>

<?php
namespace content_crm\permission\add;


class view
{
	public static function config()
	{
		\dash\permission::access('cpPermissionAdd');

		\dash\face::title(T_("Add new permissions"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Back'));

	}
}
?>
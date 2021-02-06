<?php
namespace content_cms\home;

class view
{

	public static function config()
	{
		\dash\face::title(T_('Content Management System'));

		\dash\data::back_text(T_("Dashboard"));
		\dash\data::back_link(\dash\url::kingdom(). '/a');

		\dash\data::action_text(T_('Add New Post'));
		\dash\data::action_link(\dash\url::this(). '/posts/add');

		\dash\data::dashboardDetail(\dash\app\posts\dashboard::detail());
	}
}
?>
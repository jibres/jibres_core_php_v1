<?php
namespace content_crm\member\add;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Add new user'));

		\dash\data::action_text(T_('Back to list of users'));
		\dash\data::action_link(\dash\url::this());

		\content_crm\member\main\view::static_var();
	}
}
?>
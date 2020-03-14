<?php
namespace content_account\my\social;


class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Social Networks'));

		\dash\data::action_link(\dash\url::this());
		\dash\data::action_text(T_('Back to personal info'));

		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
<?php
namespace content_account\personalization\sidebar;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Sidebar'));

		// back
		\dash\data::back_text(T_('Personalization'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>

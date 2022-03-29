<?php
namespace content_account\home;

class view
{

	public static function config()
	{
		\dash\face::title(T_('Account'));
		\dash\face::boxTitle(false);

		// back
		// \dash\data::back_text(T_('Control Center'));
		// \dash\data::back_link(\dash\url::kingdom(). '/my');

	}
}
?>
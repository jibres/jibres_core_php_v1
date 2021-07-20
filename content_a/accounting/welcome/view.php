<?php
namespace content_a\accounting\welcome;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Welcome to Cloud Accounting system'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::userToggleSidebar(false);



	}

}
?>

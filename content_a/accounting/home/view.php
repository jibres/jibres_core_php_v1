<?php
namespace content_a\accounting\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\face::btnSetting(\dash\url::here().'/setting/accounting');


	}

}
?>

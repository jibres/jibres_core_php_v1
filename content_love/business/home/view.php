<?php
namespace content_love\business\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business"));


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


	}
}
?>

<?php
namespace content_love\plugin\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business plugin list"));


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


	}
}
?>

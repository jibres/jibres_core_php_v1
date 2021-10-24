<?php
namespace content_a\premium\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Jibres premium features"));


		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
		\dash\data::back_direct(true);

		\dash\data::include_adminPanelBuilder(true);


		$args = [];

		$premium = \lib\app\premium\search::list(\dash\request::get('q'), $args);

		\dash\data::premiumList($premium);



	}
}
?>

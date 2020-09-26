<?php
namespace content_love\business\domain;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business domains"));


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::action_text(T_('Add New domain'));
		\dash\data::action_link(\dash\url::that(). '/add');


	}
}
?>

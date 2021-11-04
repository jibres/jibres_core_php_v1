<?php
namespace content_a\plugin\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Vidw plugin"));
		if(\dash\data::pluginDetail_title())
		{
			\dash\face::title(\dash\data::pluginDetail_title());
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		// load budget from jibres api
		$my_jibres_budget = \lib\api\jibres\api::budget();


		\dash\data::myBudget($my_jibres_budget);
	}
}
?>
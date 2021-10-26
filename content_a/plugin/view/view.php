<?php
namespace content_a\plugin\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Vidw plugin feature"));
		if(\dash\data::pluginDetail_title())
		{
			\dash\face::title(\dash\data::pluginDetail_title());
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		

		\dash\data::include_adminPanelBuilder(true);


		$my_jibres_budget = \lib\api\jibres\api::budget();


		\dash\data::myBudget($my_jibres_budget);




	}
}
?>
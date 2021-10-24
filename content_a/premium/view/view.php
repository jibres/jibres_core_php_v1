<?php
namespace content_a\premium\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Vidw premium feature"));
		if(\dash\data::premiumDetail_title())
		{
			\dash\face::title(\dash\data::premiumDetail_title());
		}

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
		

		\dash\data::include_adminPanelBuilder(true);




	}
}
?>
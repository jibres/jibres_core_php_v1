<?php
namespace content_cms\attachment\view;

class view
{
	public static function config()
	{

		\dash\face::title(T_("View Attachemnts"));

		\dash\data::back_text(T_("Attachemnts"));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
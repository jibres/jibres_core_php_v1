<?php
namespace content_cms\files\view;

class view
{
	public static function config()
	{

		\dash\face::title(T_("View Attachemnt"));

		\dash\data::back_text(T_("Attachemnts"));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
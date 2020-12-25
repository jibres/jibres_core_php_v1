<?php
namespace content_cms\files\add;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Add new attachemnt"));

		\dash\data::back_text(T_("Attachemnts"));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
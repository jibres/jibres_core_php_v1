<?php
namespace content_cms\posts\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new post"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this());
	}
}
?>
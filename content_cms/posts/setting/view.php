<?php
namespace content_cms\posts\setting;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Edit post setting"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/edit'. \dash\request::full_get());

	}
}
?>
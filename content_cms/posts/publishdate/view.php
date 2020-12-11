<?php
namespace content_cms\posts\publishdate;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit post publish date"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/setting'. \dash\request::full_get());

	}
}
?>
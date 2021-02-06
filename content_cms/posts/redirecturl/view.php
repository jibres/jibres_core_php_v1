<?php
namespace content_cms\posts\redirecturl;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit post redirect"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/advance'. \dash\request::full_get());

	}
}
?>
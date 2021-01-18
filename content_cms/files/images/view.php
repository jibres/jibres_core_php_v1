<?php
namespace content_cms\files\images;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Webp images"));


		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/view'. \dash\request::full_get());

	}
}
?>
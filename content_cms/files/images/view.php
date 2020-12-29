<?php
namespace content_cms\files\images;

class view
{
	public static function config()
	{

		\dash\face::title(T_("View File"));

		\dash\data::back_text(T_("Files"));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
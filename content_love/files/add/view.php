<?php
namespace content_love\files\add;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Upload"));

		\dash\data::back_text(T_("Files"));
		\dash\data::back_link(\dash\url::this(). '/datalist');

	}
}
?>
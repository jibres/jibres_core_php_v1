<?php
namespace content_cms\files\view;

class view
{
	public static function config()
	{

		\dash\face::title(T_("View File"));

		\dash\data::back_text(T_("Files"));
		\dash\data::back_link(\dash\url::this(). '/datalist');

		$usage_count = \dash\app\files\get::usage_count(\dash\request::get('id'));
		\dash\data::usageCount($usage_count);

	}
}
?>
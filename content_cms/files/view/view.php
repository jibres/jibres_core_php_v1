<?php
namespace content_cms\files\view;

class view
{
	public static function config()
	{

		\dash\face::title(T_("View File"));

		\dash\data::back_text(T_("Files"));
		\dash\data::back_link(\dash\url::this());

		$usage_list = \dash\app\files\get::usage_list(\dash\request::get('id'));
		\dash\data::usageList($usage_list);

	}
}
?>
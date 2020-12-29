<?php
namespace content_cms\files\remove;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Remove File"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/view'. \dash\request::full_get());


		$usage_list = \dash\app\files\get::usage_list(\dash\request::get('id'));
		\dash\data::usageList($usage_list);

	}
}
?>
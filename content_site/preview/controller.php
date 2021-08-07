<?php
namespace content_site\preview;


class controller
{
	public static function routing()
	{
		$section = \dash\url::child();
		$preview = \dash\url::subchild();

		$section = \dash\validate::string_100($section);
		$preview = \dash\validate::string_100($preview);


		if(!$section || !$preview)
		{
			\dash\header::status(404, T_("Invalid section name or preview key"));
			return false;
		}


		$result = \content_site\call_function::generate_preview($section, $preview);
		if(!$result)
		{
			\dash\header::status(404, T_("Invalid preview detail"));
			return false;
		}

		\dash\data::myPreviewDetail($result);

		\dash\open::get();
	}
}
?>
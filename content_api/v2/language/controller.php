<?php
namespace content_api\v2\language;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::dir(3))
		{
			\content_api\v2::invalid_url();
		}


		$lang_list = \dash\language::all();
		if(is_array($lang_list))
		{
			foreach ($lang_list as $key => $value)
			{
				$lang_list[$key]['api_url'] = \dash\url::base().'/'. $key .'/api/'. \dash\url::module();
			}
		}

		\content_api\v2::say($lang_list);
	}
}
?>
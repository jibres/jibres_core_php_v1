<?php
namespace content_site\section;


class model
{
	public static function post()
	{
		$page_id = \dash\request::get('id');


		if(\dash\request::post('section') === 'preview')
		{
			$key = \dash\request::post('key');

			$key = \dash\validate::string_100($key);

			if(!$key)
			{
				\dash\notif::error(T_("Invalid key"));
				return false;
			}

			$section_list = controller::section_list();
			$all_key = array_column($section_list, 'key');

			if(!in_array($key, $all_key))
			{
				\dash\notif::error(T_("Can not chose this section!"));
				return false;
			}

			\lib\sitebuilder\add_section::preview($page_id, $key);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('select') === 'adding')
		{
			$url = \lib\sitebuilder\add_section::select_adding($page_id);


			if($url)
			{
				\dash\redirect::pwd();
				\dash\redirect::to($url);
			}

		}
	}
}
?>
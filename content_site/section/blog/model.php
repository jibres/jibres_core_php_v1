<?php
namespace content_site\section\blog;


class model
{
	public static function post()
	{
		$page_id      = \dash\request::get('id');
		$section_id   = \dash\request::get('sid');

		$options_list = controller::options();

		$option_key   = \dash\request::post('option');

		if(!in_array($option_key, $options_list))
		{
			\dash\notif::error(T_("Invalid option"));
			return false;
		}

		$value = \dash\request::post($option_key);

		\lib\sitebuilder\options::admin_save($section_id, $option_key, $value);


	}
}
?>
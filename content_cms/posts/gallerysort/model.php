<?php
namespace content_cms\posts\gallerysort;


class model
{
	public static function post()
	{
		$gallery_list = \dash\request::post('sort');

		if($gallery_list && is_array($gallery_list))
		{
			\dash\app\posts\gallery::set_sort($gallery_list, \dash\request::get('id'));
			return true;
		}
		else
		{
			\dash\notif::error(T_("No sort data received"));
		}
	}
}
?>
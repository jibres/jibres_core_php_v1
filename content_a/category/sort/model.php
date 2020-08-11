<?php
namespace content_a\category\sort;

class model
{
	public static function post()
	{
		$category_list = \dash\request::post('sort');

		if($category_list && is_array($category_list))
		{
			\lib\app\category\edit::set_sort($category_list);
			\dash\notif::ok(T_("Sort saved"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("No sort data received"));
		}
	}
}
?>
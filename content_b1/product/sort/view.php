<?php
namespace content_b1\product\sort;


class view
{
	public static function config()
	{
		$sort_list = \lib\app\product\filter::sort_list();
		\content_b1\tools::say($sort_list);
	}
}
?>
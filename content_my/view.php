<?php
namespace content_my;


class view
{
	public static function config()
	{
		\dash\data::include_m2('dark');

		\dash\upload\size::set_default_file_size('my');
		if(\dash\url::module() === null || \dash\url::module() === 'business')
		{
			$myStore = \lib\app\store\mystore::list();
			\dash\data::listStore($myStore);
		}


	}
}
?>

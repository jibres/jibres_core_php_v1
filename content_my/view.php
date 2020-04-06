<?php
namespace content_my;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);


		if(\dash\url::module() === null || \dash\url::module() === 'store')
		{
			$myStore = \lib\app\store\mystore::list();
			\dash\data::listStore($myStore);
		}
	}
}
?>

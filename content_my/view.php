<?php
namespace content_my;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);
		\dash\data::include_highcharts(true);


		if(\dash\url::module() === null || \dash\url::module() === 'business')
		{
			$myStore = \lib\app\store\mystore::list();
			\dash\data::listStore($myStore);
		}
	}
}
?>

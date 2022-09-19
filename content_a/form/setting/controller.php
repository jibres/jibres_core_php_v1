<?php
namespace content_a\form\setting;


class controller
{
	public static function routing()
	{
		\content_a\form\tag\controller::loadForm();


		\dash\allow::file();
		\dash\allow::html();
	}
}
?>

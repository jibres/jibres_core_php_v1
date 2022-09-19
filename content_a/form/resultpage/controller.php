<?php
namespace content_a\form\resultpage;


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

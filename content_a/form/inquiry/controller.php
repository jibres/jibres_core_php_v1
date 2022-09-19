<?php
namespace content_a\form\inquiry;


class controller
{
	public static function routing()
	{
		\content_a\form\tag\controller::loadForm();


		\dash\allow::file();

	}
}
?>

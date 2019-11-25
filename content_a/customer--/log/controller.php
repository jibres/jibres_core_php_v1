<?php
namespace content_a\customer\log;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerLogView');


		\content_a\customer\load::check_access();
	}
}
?>
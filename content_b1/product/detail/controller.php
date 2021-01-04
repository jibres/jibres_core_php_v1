<?php
namespace content_b1\product\detail;


class controller
{
	public static function routing()
	{


		\dash\permission::access('ProductEdit');
	}
}
?>
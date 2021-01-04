<?php
namespace content_b1\product\remove;


class controller
{
	public static function routing()
	{


		\dash\permission::access('ProductDelete');
	}
}
?>
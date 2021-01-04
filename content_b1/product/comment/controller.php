<?php
namespace content_b1\product\comment;


class controller
{
	public static function routing()
	{


		\dash\permission::access('ProductEdit');
	}
}
?>
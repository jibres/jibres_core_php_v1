<?php
namespace content_b1\product\edit;


class controller
{
	public static function routing()
	{


		\dash\permission::access('ProductEdit');
	}
}
?>
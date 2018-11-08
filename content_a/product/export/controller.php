<?php
namespace content_a\product\export;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productExport');

	}
}
?>

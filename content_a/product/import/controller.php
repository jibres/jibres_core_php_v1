<?php
namespace content_a\product\import;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productImport');
	}
}
?>

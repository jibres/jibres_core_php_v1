<?php
namespace content_a\product\summary;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productSummary');
	}
}
?>

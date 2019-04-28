<?php
namespace content_a\product\tag;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productTag');
		\content_a\product\load::product();
	}
}
?>

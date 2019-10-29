<?php
namespace content_a\product\site;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productSite');
		\content_a\product\load::product();
	}
}
?>

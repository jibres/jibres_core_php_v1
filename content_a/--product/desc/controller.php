<?php
namespace content_a\product\desc;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productDescriptionEdit');
		\content_a\product\load::product();
	}
}
?>

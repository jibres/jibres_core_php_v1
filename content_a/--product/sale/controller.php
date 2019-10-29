<?php
namespace content_a\product\sale;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productManageSaleGateway');
		\content_a\product\load::product();
	}
}
?>

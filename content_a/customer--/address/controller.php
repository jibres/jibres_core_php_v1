<?php
namespace content_a\customer\address;

class controller
{

	public static function routing()
	{
		\dash\permission::access("customerAddressView");
		\content_a\customer\load::check_access();
	}
}
?>
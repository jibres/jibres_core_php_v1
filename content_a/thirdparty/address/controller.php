<?php
namespace content_a\thirdparty\address;

class controller
{

	public static function routing()
	{
		\dash\permission::access("thirdpartyAddressView");
		\content_a\thirdparty\load::check_access();
	}
}
?>
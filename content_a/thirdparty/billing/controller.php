<?php
namespace content_a\thirdparty\billing;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyBillingView');
		\content_a\thirdparty\load::check_access();
	}
}
?>
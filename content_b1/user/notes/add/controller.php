<?php
namespace content_b1\user\notes\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmCustomerManagement');
	}

}
?>
<?php
namespace content_b1\user\address\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmCustomerManagement');
	}

}
?>
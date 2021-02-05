<?php
namespace content_b1\user\detail;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmCustomerManagement');
	}

}
?>
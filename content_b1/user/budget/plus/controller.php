<?php
namespace content_b1\user\budget\plus;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmManageCustomerPayment');
	}

}
?>
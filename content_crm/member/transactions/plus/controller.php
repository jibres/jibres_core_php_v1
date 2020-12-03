<?php
namespace content_crm\member\transactions\plus;


class controller
{
	public static function routing()
	{
		\content_crm\member\master::load();
		\dash\permission::access('crmManageCustomerPayment');
	}
}
?>
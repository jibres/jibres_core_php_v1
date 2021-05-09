<?php
namespace content_crm\transactions\userbudget;

class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTransactionsList');

	}
}
?>
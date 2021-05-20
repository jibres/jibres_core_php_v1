<?php
namespace content_crm\transactions;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmTransactionsList');
	}
}
?>
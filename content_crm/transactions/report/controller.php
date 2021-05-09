<?php
namespace content_crm\transactions\report;

class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTransactionsList');

	}
}
?>
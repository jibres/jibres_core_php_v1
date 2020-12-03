<?php
namespace content_crm\transactions;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmTransactionsList');

		if(\dash\url::child() === 'all')
		{
			\dash\open::get();
		}
	}
}
?>
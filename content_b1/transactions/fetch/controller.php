<?php
namespace content_b1\transactions\fetch;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmTransactionsList');
	}

}
?>
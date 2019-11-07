<?php
namespace content_a\customer\plustransaction;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerTransactionPlus');
		\content_a\customer\load::check_access();
	}
}
?>
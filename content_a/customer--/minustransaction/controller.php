<?php
namespace content_a\customer\minustransaction;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerTransactionMinus');

		\content_a\customer\load::check_access();
	}
}
?>
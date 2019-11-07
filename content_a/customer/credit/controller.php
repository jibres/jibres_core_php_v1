<?php
namespace content_a\customer\credit;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerTransactionCreditView');

		\content_a\customer\load::check_access();
	}
}
?>
<?php
namespace content_a\thirdparty\plustransaction;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyTransactionPlus');
		\content_a\thirdparty\load::check_access();
	}
}
?>
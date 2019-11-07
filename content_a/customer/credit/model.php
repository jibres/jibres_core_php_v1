<?php
namespace content_a\customer\credit;


class model
{
	public static function post()
	{
		\dash\permission::access('customerTransactionCreditEdit');

		$credit = \dash\request::post('credit');
		$result = \lib\app\customer\credit::set($credit, \dash\request::get('id'));
		if($result)
		{
			\dash\redirect::pwd();
		}

	}
}
?>

<?php
namespace content_a\thirdparty\credit;


class model
{
	public static function post()
	{
		\dash\permission::access('thirdpartyTransactionCreditEdit');

		$credit = \dash\request::post('credit');
		$result = \lib\app\thirdparty\credit::set($credit, \dash\request::get('id'));
		if($result)
		{
			\dash\redirect::pwd();
		}

	}
}
?>

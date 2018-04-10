<?php
namespace content_a\factor\opr;


class model
{
	public static function post()
	{

		$post              = [];
		$factor_id         = \dash\request::get('id');
		$post['factor_id'] = $factor_id;
		$post['amount']    = \dash\request::post('amount');
		$post['type']      = \dash\request::post('type');
		$post['bank']      = \dash\request::post('bank');

		$result            = \lib\app\storetransaction::add($post);

		$new_url           = \dash\url::pwd();

		if(isset($result['complete']) && $result['complete'])
		{
			$new_url = \dash\url::this(). '/add?type=getthetypefromresult';
		}

		\dash\redirect::to($new_url);

	}
}
?>

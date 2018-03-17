<?php
namespace content_a\factor\opr;


class model extends \content_a\main\model
{
	public function post_opr()
	{

		$post              = [];
		$factor_id         = \lib\request::get('id');
		$post['factor_id'] = $factor_id;
		$post['amount']    = \lib\request::post('amount');
		$post['type']      = \lib\request::post('type');
		$post['bank']      = \lib\request::post('bank');

		$result            = \lib\app\storetransaction::add($post);

		$new_url           = \lib\url::pwd();

		if(isset($result['complete']) && $result['complete'])
		{
			$new_url = \lib\url::here(). '/add?type=getthetypefromresult';
		}

		\lib\redirect::to($new_url);

	}
}
?>

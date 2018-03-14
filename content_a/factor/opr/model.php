<?php
namespace content_a\factor\opr;


class model extends \content_a\main\model
{
	public function post_opr()
	{

		$post              = [];
		$factor_id         = \lib\utility::get('id');
		$post['factor_id'] = $factor_id;
		$post['amount']    = \lib\utility::post('amount');
		$post['type']      = \lib\utility::post('type');
		$post['bank']      = \lib\utility::post('bank');

		$result            = \lib\app\storetransaction::add($post);

		$new_url           = \lib\url::pwd();

		if(isset($result['complete']) && $result['complete'])
		{
			$new_url = $this->url('baseFull'). '/add?type=getthetypefromresult';
		}

		$this->redirector($new_url);

	}
}
?>

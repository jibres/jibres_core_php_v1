<?php
namespace content_a\factor\opr;


class model extends \content_a\main\model
{
	public function post_opr()
	{

		$pay               = \lib\utility::post('pay');
		$factor_id         = \lib\utility::get('id');
		$post              = [];
		$post['factor_id'] = $factor_id;
		$post['amount']    = \lib\utility::post('amount');

		$result = \lib\app\storetransaction::add($post);

		$new_url = $this->url('full');

		if(isset($result['complete']) && $result['complete'])
		{
			$new_url = $this->url('baseFull'). '/add?type=getthetypefromresult';
		}

		$this->redirector($new_url);

	}
}
?>

<?php
namespace content_a\sell\pay;


class model extends \content_a\main\model
{
	public function post_pay()
	{

		$pay               = \lib\utility::post('pay');
		$factor_id         = \lib\utility::get('id');
		$post              = [];
		$post['factor_id'] = $factor_id;
		$post['amount']    = \lib\utility::post('amount');

		$result = \lib\app\storetransaction::add($post);


	}
}
?>

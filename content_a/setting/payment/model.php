<?php
namespace content_a\setting\payment;


class model
{
	public static function post()
	{
		$post                       = [];
		$post['payment_online']     = \dash\request::post('payment_online');
		$post['payment_check']     = \dash\request::post('payment_check');
		$post['payment_bank']       = \dash\request::post('payment_bank');
		$post['payment_on_deliver'] = \dash\request::post('payment_on_deliver');

		\lib\app\setting\setup::save_payment($post);
	}
}
?>

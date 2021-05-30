<?php
namespace content_a\setting\order;


class model
{
	public static function post()
	{
		$post                       = [];

		if(\dash\request::post('set_payment_online'))
		{
			$post['payment_online']     = \dash\request::post('payment_online');
		}

		if(\dash\request::post('set_payment_on_deliver'))
		{
			$post['payment_on_deliver'] = \dash\request::post('payment_on_deliver');
		}


		\lib\app\setting\set::save_payment($post);
	}
}
?>

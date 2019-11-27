<?php
namespace content_a\setup\payment;


class model
{
	public static function post()
	{
		$post                       = [];
		$post['payment_online']     = \dash\request::post('payment_online');
		$post['payment_cheque']     = \dash\request::post('payment_cheque');
		$post['payment_bank']       = \dash\request::post('payment_bank');
		$post['payment_on_deliver'] = \dash\request::post('payment_on_deliver');

		\lib\app\setting\setup::save_payment($post);

		// save every field in somewhere and set the payment detail is complete
		$next_level = \lib\app\setting\setup::payment();
		\dash\redirect::to($next_level);
	}
}
?>

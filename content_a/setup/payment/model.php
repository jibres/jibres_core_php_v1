<?php
namespace content_a\setup\payment;


class model
{
	public static function post()
	{
		$post             = [];
		$post['country']  = \dash\request::post('country');
		$post['city']     = \dash\request::post('city');
		$post['payment']  = \dash\request::post('payment');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');
		$post['fax']      = \dash\request::post('fax');

		\lib\app\setting\setup::save_payment($post);
		\lib\store::refresh();
		// save every field in somewhere and set the payment detail is complete
		$next_level = \lib\app\setting\setup::payment();
		\dash\redirect::to($next_level);
	}
}
?>

<?php
namespace content_a\setup\shipping;


class model
{
	public static function post()
	{
		$post             = [];
		$post['country']  = \dash\request::post('country');
		$post['city']     = \dash\request::post('city');
		$post['shipping']  = \dash\request::post('shipping');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');
		$post['fax']      = \dash\request::post('fax');

		\lib\app\setting\setup::save_shipping($post);
		\lib\store::refresh();
		// save every field in somewhere and set the shipping detail is complete
		$next_level = \lib\app\setting\setup::shipping();
		\dash\redirect::to($next_level);
	}
}
?>

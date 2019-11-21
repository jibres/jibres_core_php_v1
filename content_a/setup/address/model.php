<?php
namespace content_a\setup\address;


class model
{
	public static function post()
	{
		$post             = [];
		$post['country']  = \dash\request::post('country');
		$post['city']     = \dash\request::post('city');
		$post['address']  = \dash\request::post('address');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');
		$post['fax']      = \dash\request::post('fax');

		\lib\app\setting\setup::save_address($post);
		\lib\store::refresh();
		// save every field in somewhere and set the address detail is complete
		$next_level = \lib\app\setting\setup::address();
		\dash\redirect::to($next_level);
	}
}
?>

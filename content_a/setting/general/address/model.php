<?php
namespace content_a\setting\general\address;


class model
{
	public static function post()
	{
		$post             = [];
		$post['country']  = \dash\request::post('country');
		$post['city']     = \dash\request::post('city');
		$post['province'] = \dash\request::post('province');
		$post['address']  = \dash\request::post('address');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');
		$post['fax']      = \dash\request::post('fax');

		\lib\app\setting\setup::save_address($post);
	}
}
?>

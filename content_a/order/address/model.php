<?php
namespace content_a\order\address;


class model
{

	public static function post()
	{
		$post             = [];
		$post['name']     = \dash\request::post('name');
		$post['country']  = \dash\request::post('country');
		$post['province'] = \dash\request::post('province');
		$post['city']     = \dash\request::post('city');
		$post['address']  = \dash\request::post('address');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');

		\lib\app\factor\edit::edit_address($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

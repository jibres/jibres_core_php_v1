<?php
namespace content_subdomain\shiping;


class model
{
	public static function post()
	{

		$post                = [];
		$post['title']       = \dash\request::post('title');
		$post['name']        = \dash\request::post('name');
		$post['country']     = \dash\request::post('country');
		$post['city']        = \dash\request::post('city');
		$post['postcode']    = \dash\request::post('postcode');
		$post['phone']       = \dash\request::post('phone');
		$post['province']    = null;
		$post['mobile']      = \dash\request::post('mobile');
		$post['address']     = \dash\request::post('address');
		$post['address2']    = \dash\request::post('address2');
		$post['company']     = \dash\request::post('company');

		$result = \dash\app\address::add($post);
		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Address successfully added"));
			\dash\redirect::pwd();
		}


		\dash\notif::warn('not ready');
		return false;

	}
}
?>

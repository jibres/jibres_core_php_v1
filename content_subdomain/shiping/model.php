<?php
namespace content_subdomain\shiping;


class model
{
	public static function post()
	{
		$post             = [];
		$post['title']    = \dash\request::post('title');
		$post['name']     = \dash\request::post('name');
		$post['country']  = \dash\request::post('country');
		$post['province'] = \dash\request::post('province');
		$post['city']     = \dash\request::post('city');
		$post['address']  = \dash\request::post('address');
		$post['postcode'] = \dash\request::post('postcode');
		$post['phone']    = \dash\request::post('phone');
		$post['mobile']   = \dash\request::post('mobile');

		\dash\notif::warn('not ready');
		return false;

	}
}
?>

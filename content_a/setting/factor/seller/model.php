<?php
namespace content_a\setting\factor\seller;


class model
{
	public static function post()
	{
		$post                          = [];
		$post['companyeconomiccode']   = \dash\request::post('companyeconomiccode');
		$post['companynationalid']     = \dash\request::post('companynationalid');
		$post['companyregisternumber'] = \dash\request::post('companyregisternumber');
		$post['ceonationalcode']       = \dash\request::post('ceonationalcode');
		$post['companyname']           = \dash\request::post('companyname');
		$post['local_website']         = \dash\request::post('website');
		$post['seller_type']           = \dash\request::post('seller_type');
		$post['nationalcode']          = \dash\request::post('nationalcode');

		\lib\app\setting\set::seller_detail($post);

		\dash\notif::ok(T_("Saved"));

	}
}
?>

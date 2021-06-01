<?php
namespace content_a\setting\factor\address;


class model
{
	public static function post()
	{
		$post             = [];
		$post['factor_country']  = \dash\request::post('country');
		$post['factor_city']     = \dash\request::post('city');
		$post['factor_province'] = \dash\request::post('province');
		$post['factor_address']  = \dash\request::post('address');
		$post['factor_postcode'] = \dash\request::post('postcode');
		$post['factor_phone']    = \dash\request::post('phone');
		$post['factor_mobile']   = \dash\request::post('mobile');
		$post['factor_fax']      = \dash\request::post('fax');

		\lib\app\setting\set::factor_address($post);

		\dash\notif::ok(T_("Saved"));
	}
}
?>
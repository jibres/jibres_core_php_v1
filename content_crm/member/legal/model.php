<?php
namespace content_crm\member\legal;


class model
{

	public static function post()
	{
		$post =
		[
			'companyname'           => \dash\request::post('companyname'),
			'companyregisternumber' => \dash\request::post('companyregisternumber'),
			'companynationalid'     => \dash\request::post('companynationalid'),
			'companyeconomiccode'   => \dash\request::post('companyeconomiccode'),
			'ceonationalcode'       => \dash\request::post('ceonationalcode'),
			'country'               => \dash\request::post('country'),
			'province'              => \dash\request::post('province'),
			'city'                  => \dash\request::post('city'),
			'address'               => \dash\request::post('address'),
			'postcode'              => \dash\request::post('postcode'),
			'phone'                 => \dash\request::post('phone'),
			'fax'                   => \dash\request::post('fax'),
		];


		\dash\app\user\legal::set($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
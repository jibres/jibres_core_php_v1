<?php
namespace content_my\ipg\profile;


class model
{
	public static function post()
	{
		$post =
		[
			'type'                  => \dash\request::get('type'),

			'gender'                => \dash\request::post('gender'),
			'firstname'             => \dash\request::post('firstname'),
			'firstname_en'          => \dash\request::post('firstname_en'),
			'lastname'              => \dash\request::post('lastname'),
			'lastname_en'           => \dash\request::post('lastname_en'),
			'father'                => \dash\request::post('father'),
			'father_en'             => \dash\request::post('father_en'),
			'nationalcode'          => \dash\request::post('nationalcode'),
			'birthdate'             => \dash\request::post('birthdate'),
			'companyname'           => \dash\request::post('companyname'),
			'companyname_en'        => \dash\request::post('companyname_en'),
			'companynationalid'     => \dash\request::post('companynationalid'),
			'companyregisternumber' => \dash\request::post('companyregisternumber'),
			'ceonationalcode'       => \dash\request::post('ceonationalcode'),
			'phone'                 => \dash\request::post('phone'),
		];

		\lib\app\shaparak\profile\set::user_set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
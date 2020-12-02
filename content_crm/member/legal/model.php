<?php
namespace content_crm\member\legal;


class model
{

	public static function post()
	{

		$post =
		[
			'website'               => \dash\request::post('website'),
			'accounttype'             => \dash\request::post('accounttype'),
			'companyname'           => \dash\request::post('companyname'),
			'companyregisternumber' => \dash\request::post('companyregisternumber'),
			'companynationalid'     => \dash\request::post('companynationalid'),
			'companyeconomiccode'   => \dash\request::post('companyeconomiccode'),
			'nationalcode'          => \dash\request::post('nationalcode'),
		];


		\dash\app\user::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>
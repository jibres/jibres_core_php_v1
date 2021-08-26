<?php
namespace content_my\domain\whoisdetail;



class model
{

	public static function whoisdetail_person()
	{
		return
		[
			'company'      => 'Jibres', // \dash\request::post('org'),
			'nationalcode' => '', // \dash\request::post('nationalcode'),
			'country'      => 'US', // \dash\request::post('country'),
			'province'     => 'NC', // \dash\request::post('province'),
			'city'         => 'HENDERSON', // \dash\request::post('city'),
			'address'      => '4483 EDWARDS STREET', // \dash\request::post('address'),
			'postcode'     => '27536', // \dash\request::post('postcode'),
			'phonecc'      => '1', // \dash\request::post('phonecc'),
			'phone'        => '2526540524', // \dash\request::post('phone'),
			'faxcc'        => '1', // \dash\request::post('faxcc'),
			'fax'          => '2526540524', // \dash\request::post('fax'),
		];
	}


	public static function post()
	{
		$post =
		[
				// .com request
			'fullname' => \dash\request::post('fullname'),
			'email'    => \dash\request::post('email'),
		];

		$post = array_merge(\content_my\domain\whoisdetail\model::whoisdetail_person(), $post);

		\lib\app\nic_usersetting\set::set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}



	}
}
?>
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
			'country'      => 'AU', // \dash\request::post('country'),
			'province'     => 'New South Wales', // \dash\request::post('province'),
			'city'         => 'Sydney', // \dash\request::post('city'),
			'address'      => 'St. 14 No 313', // \dash\request::post('address'),
			'postcode'     => '37148313', // \dash\request::post('postcode'),
			'phonecc'      => '43', // \dash\request::post('phonecc'),
			'phone'        => '06883544524', // \dash\request::post('phone'),
			'faxcc'        => '43', // \dash\request::post('faxcc'),
			'fax'          => '06883544524', // \dash\request::post('fax'),
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
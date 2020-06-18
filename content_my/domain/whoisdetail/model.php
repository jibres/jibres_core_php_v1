<?php
namespace content_my\domain\whoisdetail;



class model
{
	public static function post()
	{
		$post =
		[
				// .com request
			'fullname'     => \dash\request::post('fullname'),
			'company'      => \dash\request::post('org'),
			'nationalcode' => \dash\request::post('nationalcode'),
			'country'      => \dash\request::post('country'),
			'province'     => \dash\request::post('province'),
			'city'         => \dash\request::post('city'),
			'address'      => \dash\request::post('address'),
			'postcode'     => \dash\request::post('postcode'),

			'phonecc'      => \dash\request::post('phonecc'),
			'phone'        => \dash\request::post('phone'),
			'faxcc'        => \dash\request::post('faxcc'),
			'fax'        => \dash\request::post('fax'),
			'email'        => \dash\request::post('email'),

		];

		\lib\app\nic_usersetting\set::set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}



	}
}
?>
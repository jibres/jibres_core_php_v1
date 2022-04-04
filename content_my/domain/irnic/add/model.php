<?php
namespace content_my\domain\irnic\add;


class model
{
	public static function post()
	{
		if(\dash\request::post('oldcontact'))
		{
			$check = \lib\app\nic_contact\add::exists_contact(\dash\request::post('oldcontact'), \dash\request::post('titleold'));

			if($check)
			{
				\dash\redirect::to(\dash\url::that());
			}
		}
		else
		{

			\dash\notif::error(T_("Please go to nic.ir and create your account in that site"));
			return false;

			$post =
			[
				'title'        => \dash\request::post('title'),
				'firstname'    => \dash\request::post('firstname'),
				'lastname'     => \dash\request::post('lastname'),
				'nationalcode' => \dash\request::post('nationalcode'),
				'email'        => \dash\request::post('email'),
				'country'      => \dash\request::post('country'),
				'province'     => \dash\request::post('province'),
				'city'         => \dash\request::post('city'),
				'postcode'     => \dash\request::post('postcode'),
				'phone'        => \dash\request::post('phone'),
				'address'      => \dash\request::post('address'),
			];

			$create = \lib\app\nic_contact\add::create_new($post);

			if($create)
			{
				\dash\redirect::to(\dash\url::that());
			}

		}

	}
}
?>
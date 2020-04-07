<?php
namespace content_my\domain\irnic\add;


class model
{
	public static function post()
	{
		if(\dash\request::post('oldcontact'))
		{
			if(\dash\url::isLocal())
			{
				$get_api = new \lib\nic\api();
				$check   = $get_api->contact_add_exists(\dash\request::post('oldcontact'), \dash\request::post('titleold'));
			}
			else
			{
				$check = \lib\app\nic_contact\add::exists_contact(\dash\request::post('oldcontact'), \dash\request::post('titleold'));
			}

			if($check)
			{
				\dash\redirect::to(\dash\url::that());
			}
		}
		else
		{
			// if(!\dash\request::post('agree'))
			// {
			// 	\dash\notif::warn(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
			// 	return false;
			// }

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

			if(\dash\url::isLocal())
			{
				$get_api = new \lib\nic\api();
				$create = $get_api->contact_create_new($post);
			}
			else
			{
				$create = \lib\app\nic_contact\add::create_new($post);
			}

			if($create)
			{
				\dash\redirect::to(\dash\url::that());
			}

		}

	}
}
?>
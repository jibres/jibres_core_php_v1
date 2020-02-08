<?php
namespace content_domain\contact\add;


class model
{
	public static function post()
	{
		if(\dash\request::post('oldcontact'))
		{
			$check = \lib\app\nic_contact\add::exists_contact(\dash\request::post('oldcontact'));
			if($check)
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
		else
		{
			if(!\dash\request::post('agree'))
			{
				\dash\notif::warn(T_("Please view the privacy polici and check 'I agree' check box"), 'agree');
				return false;
			}

			$post =
			[
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
				\dash\redirect::to(\dash\url::this());
			}

		}

	}
}
?>
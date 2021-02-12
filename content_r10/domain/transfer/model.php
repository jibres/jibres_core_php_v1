<?php
namespace content_r10\domain\transfer;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'       => \dash\request::input_body('domain'),
			'nic_id'       => \dash\request::input_body('irnicid'),
			'irnic_new'    => \dash\request::input_body('irnicid-new'),
			'pin'          => \dash\request::input_body('pin'),

			// .com request
			'fullname'     => \dash\request::input_body('fullname'),
			'org'          => \dash\request::input_body('org'),
			'nationalcode' => \dash\request::input_body('nationalcode'),
			'country'      => \dash\request::input_body('country'),
			'province'     => \dash\request::input_body('province'),
			'city'         => \dash\request::input_body('city'),
			'address'      => \dash\request::input_body('address'),
			'postcode'     => \dash\request::input_body('postcode'),

			'phonecc'      => \dash\request::input_body('phonecc'),
			'phone'        => \dash\request::input_body('phone'),
			'faxcc'        => \dash\request::input_body('faxcc'),
			'fax'          => \dash\request::input_body('fax'),

			'email'        => \dash\request::input_body('email'),

			'agree'        => \dash\request::input_body('agree'),

			'register_now' => true,

		];

		$result = \lib\app\domains\transfer::transfer($post);


		\content_r10\tools::say($result);
	}
}
?>
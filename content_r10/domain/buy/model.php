<?php
namespace content_r10\domain\buy;


class model
{
	public static function post()
	{

		$post =
		[
			'domain'       => \dash\request::input_body('domain'),
			'nic_id'       => \dash\request::input_body('irnicid'),
			'period'       => \dash\request::input_body('period'),
			'irnic_new'    => \dash\request::input_body('irnicid-new'),
			'irnic_admin'  => \dash\request::input_body('irnic_admin'),
			'irnic_tech'   => \dash\request::input_body('irnic_tech'),
			'irnic_bill'   => \dash\request::input_body('irnic_bill'),
			'ns1'          => \dash\request::input_body('ns1'),
			'ns2'          => \dash\request::input_body('ns2'),
			'ns3'          => \dash\request::input_body('ns3'),
			'ns4'          => \dash\request::input_body('ns4'),
			'dnsid'        => \dash\request::input_body('dnsid'),


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

		$result = \lib\app\domains\create::new_domain($post);

		\content_r10\tools::say($result);
	}
}
?>
<?php
namespace content_r10\domain\buy;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'       => \dash\request::input_body('domain'),
			'nic_id'       => \dash\request::input_body('nic_id'),
			'period'       => \dash\request::input_body('period'),
			'irnic_new'    => \dash\request::input_body('irnic_new'),
			'irnic_admin'  => \dash\request::input_body('irnic_admin'),
			'irnic_tech'   => \dash\request::input_body('irnic_tech'),
			'irnic_bill'   => \dash\request::input_body('irnic_bill'),
			'ns1'          => \dash\request::input_body('ns1'),
			'ns2'          => \dash\request::input_body('ns2'),
			'ns3'          => \dash\request::input_body('ns3'),
			'ns4'          => \dash\request::input_body('ns4'),
			'dnsid'        => \dash\request::input_body('dnsid'),
			'agree'        => \dash\request::input_body('agree'),
			'register_now' => true,
		];

		$result = \lib\app\nic_domain\create::new_domain($post);

		\content_r10\tools::say($result);
	}
}
?>
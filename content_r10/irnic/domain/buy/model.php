<?php
namespace content_r10\irnic\domain\buy;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'       => \content_r10\tools::input_body('domain'),
			'nic_id'       => \content_r10\tools::input_body('nic_id'),
			'period'       => \content_r10\tools::input_body('period'),
			'irnic_new'    => \content_r10\tools::input_body('irnic_new'),
			'irnic_admin'  => \content_r10\tools::input_body('irnic_admin'),
			'irnic_tech'   => \content_r10\tools::input_body('irnic_tech'),
			'irnic_bill'   => \content_r10\tools::input_body('irnic_bill'),
			'ns1'          => \content_r10\tools::input_body('ns1'),
			'ns2'          => \content_r10\tools::input_body('ns2'),
			'ns3'          => \content_r10\tools::input_body('ns3'),
			'ns4'          => \content_r10\tools::input_body('ns4'),
			'dnsid'        => \content_r10\tools::input_body('dnsid'),
			'agree'        => \content_r10\tools::input_body('agree'),
			'register_now' => true,
		];

		$result = \lib\app\nic_domain\create::new_domain($post);

		\content_r10\tools::say($result);
	}
}
?>
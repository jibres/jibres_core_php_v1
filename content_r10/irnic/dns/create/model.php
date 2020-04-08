<?php
namespace content_r10\irnic\dns\create;


class model
{
	public static function post()
	{
		$post              = [];
		$post['title']     = \content_r10\tools::input_body('title');
		$post['isdefault'] = \content_r10\tools::input_body('isdefault');
		$post['ns1']       = \content_r10\tools::input_body('ns1');
		$post['ns2']       = \content_r10\tools::input_body('ns2');
		$post['ip1']       = \content_r10\tools::input_body('ip1');
		$post['ip2']       = \content_r10\tools::input_body('ip2');
		$post['ns3']       = \content_r10\tools::input_body('ns3');
		$post['ns4']       = \content_r10\tools::input_body('ns4');
		$post['ip3']       = \content_r10\tools::input_body('ip3');
		$post['ip4']       = \content_r10\tools::input_body('ip4');

		$create = \lib\app\nic_dns\add::new_record($post);

		\content_r10\tools::say($create);

	}
}
?>
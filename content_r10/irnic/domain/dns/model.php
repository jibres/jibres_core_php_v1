<?php
namespace content_r10\irnic\domain\dns;


class model
{
	public static function patch()
	{
		$patch = [];

		if(\content_r10\tools::isset_input_body('ns1'))  $patch['ns1'] = \content_r10\tools::input_body('ns1');
		if(\content_r10\tools::isset_input_body('ns2'))  $patch['ns2'] = \content_r10\tools::input_body('ns2');
		if(\content_r10\tools::isset_input_body('ns3'))  $patch['ns3'] = \content_r10\tools::input_body('ns3');
		if(\content_r10\tools::isset_input_body('ns4'))  $patch['ns4'] = \content_r10\tools::input_body('ns4');
		if(\content_r10\tools::isset_input_body('ip1'))  $patch['ip1'] = \content_r10\tools::input_body('ip1');
		if(\content_r10\tools::isset_input_body('ip2'))  $patch['ip2'] = \content_r10\tools::input_body('ip2');
		if(\content_r10\tools::isset_input_body('ip3'))  $patch['ip3'] = \content_r10\tools::input_body('ip3');
		if(\content_r10\tools::isset_input_body('ip4'))  $patch['ip4'] = \content_r10\tools::input_body('ip4');

		$result = \lib\app\nic_domain\edit::domain($patch, \dash\request::get('id'), 'dns');

		\content_r10\tools::say($result);
	}
}
?>
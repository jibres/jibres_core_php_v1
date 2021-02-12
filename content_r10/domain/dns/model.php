<?php
namespace content_r10\domain\dns;


class model
{
	public static function patch()
	{
		$patch = [];

		if(\dash\request::isset_input_body('ns1'))  $patch['ns1'] = \dash\request::input_body('ns1');
		if(\dash\request::isset_input_body('ns2'))  $patch['ns2'] = \dash\request::input_body('ns2');
		if(\dash\request::isset_input_body('ns3'))  $patch['ns3'] = \dash\request::input_body('ns3');
		if(\dash\request::isset_input_body('ns4'))  $patch['ns4'] = \dash\request::input_body('ns4');
		if(\dash\request::isset_input_body('ip1'))  $patch['ip1'] = \dash\request::input_body('ip1');
		if(\dash\request::isset_input_body('ip2'))  $patch['ip2'] = \dash\request::input_body('ip2');
		if(\dash\request::isset_input_body('ip3'))  $patch['ip3'] = \dash\request::input_body('ip3');
		if(\dash\request::isset_input_body('ip4'))  $patch['ip4'] = \dash\request::input_body('ip4');

		$result = \lib\app\domains\edit::dns($patch, \dash\request::get('id'));

		\content_r10\tools::say($result);
	}
}
?>
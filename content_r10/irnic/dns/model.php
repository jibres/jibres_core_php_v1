<?php
namespace content_r10\irnic\dns;


class model
{
	public static function delete()
	{
		$result = \lib\app\nic_dns\edit::remove(\dash\request::get('id'));
		\content_r10\tools::say($result);
	}

	public static function patch()
	{
		$patch = [];

		if(\content_r10\tools::isset_input_body('title'))  		$patch['title']   	    = \content_r10\tools::input_body('title');
		if(\content_r10\tools::isset_input_body('isdefault'))    $patch['isdefault']     = \content_r10\tools::input_body('isdefault');
		if(\content_r10\tools::isset_input_body('ns1'))    		$patch['ns1']		    = \content_r10\tools::input_body('ns1');
		if(\content_r10\tools::isset_input_body('ns2'))    		$patch['ns2']		    = \content_r10\tools::input_body('ns2');
		if(\content_r10\tools::isset_input_body('ip1'))    		$patch['ip1']		    = \content_r10\tools::input_body('ip1');
		if(\content_r10\tools::isset_input_body('ip2'))    		$patch['ip2']		    = \content_r10\tools::input_body('ip2');
		if(\content_r10\tools::isset_input_body('ns3'))    		$patch['ns3']		    = \content_r10\tools::input_body('ns3');
		if(\content_r10\tools::isset_input_body('ns4'))    		$patch['ns4']		    = \content_r10\tools::input_body('ns4');
		if(\content_r10\tools::isset_input_body('ip3'))    		$patch['ip3']		    = \content_r10\tools::input_body('ip3');
		if(\content_r10\tools::isset_input_body('ip4'))    		$patch['ip4']		    = \content_r10\tools::input_body('ip4');

		$result = \lib\app\nic_dns\edit::edit($patch, \dash\request::get('id'));

		\content_r10\tools::say($result);
	}
}
?>
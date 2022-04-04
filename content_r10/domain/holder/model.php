<?php
namespace content_r10\domain\holder;


class model
{
	public static function patch()
	{
		$patch = [];

		if(\dash\request::isset_input_body('tech'))  		$patch['tech']   	= \dash\request::input_body('tech');
		if(\dash\request::isset_input_body('bill'))  		$patch['bill']   	    = \dash\request::input_body('bill');
		// if(\dash\request::isset_input_body('reseller'))  		$patch['reseller']   	    = \dash\request::input_body('reseller');



		$result = \lib\app\nic_domain\edit::domain($patch, \lib\app\domains\get::my_domain_id_api(), 'holder');

		\content_r10\tools::say($result);
	}
}
?>
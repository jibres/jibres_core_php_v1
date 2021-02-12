<?php
namespace content_r10\domain\holder;


class model
{
	public static function patch()
	{
		$patch = [];

		if(\dash\request::isset_input_body('tech'))  		$patch['tech']   	= \dash\request::input_body('tech');
		if(\dash\request::isset_input_body('bill'))  		$patch['bill']   	    = \dash\request::input_body('bill');

		$result = \lib\app\nic_domain\edit::domain($patch, \dash\request::get('id'), 'holder');

		\content_r10\tools::say($result);
	}
}
?>
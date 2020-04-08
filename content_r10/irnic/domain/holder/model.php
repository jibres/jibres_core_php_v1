<?php
namespace content_r10\irnic\domain\holder;


class model
{
	public static function patch()
	{
		$patch = [];

		if(\content_r10\tools::isset_input_body('tech'))  		$patch['tech']   	= \content_r10\tools::input_body('tech');
		if(\content_r10\tools::isset_input_body('bill'))  		$patch['bill']   	    = \content_r10\tools::input_body('bill');

		$result = \lib\app\nic_domain\edit::domain($patch, \dash\request::get('id'), 'holder');

		\content_r10\tools::say($result);
	}
}
?>
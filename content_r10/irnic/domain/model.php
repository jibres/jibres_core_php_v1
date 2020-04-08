<?php
namespace content_r10\irnic\domain;


class model
{
	public static function delete()
	{
		$result = \lib\app\nic_domain\edit::remove(\dash\request::get('id'));
		\content_r10\tools::say($result);
	}

	public static function patch()
	{
		$patch = [];

		if(\content_r10\tools::isset_input_body('autorenew'))  		$patch['autorenew']   	= \content_r10\tools::input_body('autorenew');
		if(\content_r10\tools::isset_input_body('status'))  		$patch['status']   	    = \content_r10\tools::input_body('status');

		$result = \lib\app\nic_domain\edit::edit($patch, \dash\request::get('id'));

		\content_r10\tools::say($result);
	}
}
?>
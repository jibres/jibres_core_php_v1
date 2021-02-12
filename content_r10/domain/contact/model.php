<?php
namespace content_r10\contact;


class model
{
	public static function delete()
	{
		$result = \lib\app\nic_contact\edit::remove(\dash\request::get('id'));
		\content_r10\tools::say($result);
	}

	public static function patch()
	{
		$patch = [];

		if(\dash\request::isset_input_body('title'))  		$patch['title']   	    = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('isdefault'))    $patch['isdefault']     = \dash\request::input_body('isdefault');

		$result = \lib\app\nic_contact\edit::edit($patch, \dash\request::get('id'));

		\content_r10\tools::say($result);
	}
}
?>
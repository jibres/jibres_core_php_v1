<?php
namespace content_r10\irnic\contact;


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

		if(\content_v2\tools::isset_input_body('title'))  		$patch['title']   	    = \content_v2\tools::input_body('title');
		if(\content_v2\tools::isset_input_body('isdefault'))    $patch['isdefault']     = \content_v2\tools::input_body('isdefault');

		$result = \lib\app\nic_contact\edit::edit($patch, \dash\request::get('id'));

		\content_r10\tools::say($result);
	}
}
?>
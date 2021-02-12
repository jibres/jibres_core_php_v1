<?php
namespace content_r10\contact\add;


class model
{

	public static function post()
	{
		$oldcontact = null;

		if(\dash\request::isset_input_body('contact_id'))
		{
		 	$oldcontact   = \dash\request::input_body('contact_id');
		}

		$check = \lib\app\nic_contact\add::exists_contact($oldcontact, null);

		\content_r10\tools::say($check);
	}
}
?>
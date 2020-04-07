<?php
namespace content_r10\irnic\contact\add;


class model
{

	public static function post()
	{
		$oldcontact = null;

		if(\content_r10\tools::isset_input_body('contact_id'))
		{
		 	$oldcontact   = \content_r10\tools::input_body('contact_id');
		}

		$check = \lib\app\nic_contact\add::exists_contact($oldcontact, null);

		\content_r10\tools::say($check);
	}
}
?>
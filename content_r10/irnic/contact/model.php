<?php
namespace content_r10\irnic\contact;


class model
{
	public static function delete()
	{
		$result = \lib\app\nic_contact\edit::remove(\dash\request::get('id'));
		\content_r10\tools::say($result);
	}
}
?>
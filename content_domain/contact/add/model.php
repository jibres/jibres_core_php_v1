<?php
namespace content_domain\contact\add;


class model
{
	public static function post()
	{
		if(\dash\request::post('oldcontact'))
		{
			$check = \lib\app\nic_contact\add::exists_contact(\dash\request::post('oldcontact'));
		}

	}
}
?>
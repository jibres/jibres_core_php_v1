<?php
namespace content_r10\domain\remove;


class model
{
	public static function delete()
	{
		$result = \lib\app\nic_domain\remove::remove(\dash\request::get('id'));
		\content_r10\tools::say($result);
	}

}
?>
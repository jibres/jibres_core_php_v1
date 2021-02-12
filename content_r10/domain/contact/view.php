<?php
namespace content_r10\contact;


class view
{
	public static function config()
	{
		$result = \lib\app\nic_contact\get::load();
		\content_r10\tools::say($result);
	}
}
?>
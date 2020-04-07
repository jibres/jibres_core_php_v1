<?php
namespace content_r10\irnic\domain;


class view
{
	public static function config()
	{
		$result = \lib\app\nic_contact\get::load();
		\content_r10\tools::say($result);
	}
}
?>
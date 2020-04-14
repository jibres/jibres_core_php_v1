<?php
namespace content_r10\irnic\dns;


class view
{
	public static function config()
	{
		$result = \lib\app\nic_dns\get::load();
		\content_r10\tools::say($result);
	}
}
?>
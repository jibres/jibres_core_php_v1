<?php
namespace content_r10\irnic\poll;


class view
{
	public static function config()
	{
		$my_list = \lib\app\nic_poll\get::my_list();
		\content_r10\tools::say($my_list);
	}
}
?>
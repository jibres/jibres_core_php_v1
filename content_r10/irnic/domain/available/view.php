<?php
namespace content_r10\irnic\domain\available;


class view
{
	public static function config()
	{
		$q    = \dash\request::get('domain');
		$info = \lib\app\nic_domain\check::check($q);
		\content_r10\tools::say($info);
	}
}
?>
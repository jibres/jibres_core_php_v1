<?php
namespace content_r10\irnic\domain\check;


class view
{
	public static function config()
	{
		$q    = \dash\request::get('domain');
		$info = \lib\app\nic_domain\check::multi_check($q);
		\content_r10\tools::say($info);
	}
}
?>
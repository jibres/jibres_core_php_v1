<?php
namespace content_r10\irnic\domain\detail;


class view
{
	public static function config()
	{
		$domain      = \dash\request::get('domain');
		$load_domain = \lib\app\nic_domain\get::is_my_domain($domain);
		\content_r10\tools::say($load_domain);
	}
}
?>
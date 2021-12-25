<?php
namespace content_r10\domain\whois;


class view
{
	public static function config()
	{
		$q    = \dash\request::get('domain');
		$check = \lib\app\whois\who::is($q);
		\content_r10\tools::say($check);
	}
}
?>
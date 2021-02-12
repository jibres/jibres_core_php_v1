<?php
namespace content_r10\domain\available;


class view
{
	public static function config()
	{
		$q    = \dash\request::get('domain');
		$check = \lib\app\domains\check::check($q);
		\content_r10\tools::say($check);
	}
}
?>
<?php
namespace content_r10\domain\suggest;


class view
{
	public static function config()
	{
		$q    = \dash\request::get('domain');
		$info = \lib\app\domains\check::multi_check($q);
		\content_r10\tools::say($info);
	}
}
?>
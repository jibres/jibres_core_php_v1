<?php
namespace content_b1\unit\fetch;


class view
{
	public static function config()
	{
		$list = \lib\app\product\unit::list();
		\content_b1\tools::say($list);
	}

}
?>
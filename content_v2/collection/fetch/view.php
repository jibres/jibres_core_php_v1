<?php
namespace content_v2\collection\fetch;


class view
{
	public static function config()
	{
		$list = \lib\app\category\search::list();
		\content_v2\tools::say($list);
	}

}
?>
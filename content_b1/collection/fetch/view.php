<?php
namespace content_b1\collection\fetch;


class view
{
	public static function config()
	{
		$list = \lib\app\category\search::list();
		\content_b1\tools::say($list);
	}

}
?>
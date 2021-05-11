<?php
namespace content_b1\collection\fetch;


class view
{
	public static function config()
	{
		$list = \lib\app\tag\search::list();
		\content_b1\tools::say($list);
	}

}
?>
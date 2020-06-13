<?php
namespace content_b1\company\fetch;


class view
{
	public static function config()
	{
		$list = \lib\app\product\company::list();
		\content_b1\tools::say($list);
	}

}
?>
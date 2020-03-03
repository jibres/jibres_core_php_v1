<?php
namespace content_v2\company\fetch;


class view
{
	public static function config()
	{
		$list = \lib\app\product\company::list();
		\content_v2\tools::say($list);
	}

}
?>
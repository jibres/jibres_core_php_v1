<?php
namespace content_b1\posts\fetch\sort;


class view
{

	public static function config()
	{
		$result = \dash\app\posts\filter::sort_list();

		\content_b1\tools::say($result);
	}

}
?>
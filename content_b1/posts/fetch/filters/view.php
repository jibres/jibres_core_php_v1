<?php
namespace content_b1\posts\fetch\filters;


class view
{

	public static function config()
	{
		$result = \dash\app\posts\filter::list();

		\content_b1\tools::say($result);
	}

}
?>
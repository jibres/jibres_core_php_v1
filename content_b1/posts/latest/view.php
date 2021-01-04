<?php
namespace content_b1\posts\latest;


class view
{

	public static function config()
	{

		$args             = [];

		$result = \dash\app\posts\search::api_lates_post($args);

		\content_b1\tools::say($result);
	}

}
?>
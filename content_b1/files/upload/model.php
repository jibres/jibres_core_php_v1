<?php
namespace content_b1\files\upload;


class model
{

	public static function post()
	{
		$result        = \content_cms\files\add\model::post();

		if($result)
		{
			$result = \dash\app\files\ready::row($result);
		}

		\content_b1\tools::say($result);
	}
}
?>
<?php
namespace content_b1\ticket\add;


class model
{


	public static function post()
	{
		// $via     = 'api';
		$via     = null;
		$content = \content_b1\tools::input_body('content');
		$title   = \content_b1\tools::input_body('title');
		$file    = null;
		$result  = \content_support\ticket\add\model::add_new($via, $content, $file, $title);

		\content_b1\tools::say($result);
	}
}
?>
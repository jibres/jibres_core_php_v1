<?php
namespace content_b1\category\add;


class model
{

	public static function post()
	{
		$args             = [];
		$args['title']    = \content_b1\tools::input_body('title');
		$args['slug']     = \content_b1\tools::input_body('slug');
		$args['parent']   = \content_b1\tools::input_body('parent');
		$args['desc']     = \content_b1\tools::input_body('desc');
		$args['seotitle'] = \content_b1\tools::input_body('seotitle');
		$args['seodesc']  = \content_b1\tools::input_body('seodesc');

		$result = \lib\app\category\add::add($args);

		\content_b1\tools::say($result);
	}

}
?>
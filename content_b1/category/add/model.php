<?php
namespace content_b1\category\add;


class model
{

	public static function post()
	{
		$args             = [];
		$args['title']    = \dash\request::input_body('title');
		$args['slug']     = \dash\request::input_body('slug');
		$args['parent']   = \dash\request::input_body('parent');
		$args['desc']     = \dash\request::input_body('desc');
		$args['seotitle'] = \dash\request::input_body('seotitle');
		$args['seodesc']  = \dash\request::input_body('seodesc');

		$result = \lib\app\category\add::add($args);

		\content_b1\tools::say($result);
	}

}
?>
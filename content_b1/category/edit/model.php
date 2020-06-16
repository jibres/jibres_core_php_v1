<?php
namespace content_b1\category\edit;


class model
{

	public static function put()
	{
		$id = \dash\request::get('id');
		$id = \dash\validate::id($id);

		$args             = [];
		$args['title']    = \content_b1\tools::input_body('title');
		$args['slug']     = \content_b1\tools::input_body('slug');
		$args['parent']   = \content_b1\tools::input_body('parent');
		$args['desc']     = \content_b1\tools::input_body('desc');
		$args['seotitle'] = \content_b1\tools::input_body('seotitle');
		$args['seodesc']  = \content_b1\tools::input_body('seodesc');

		$property  = \content_b1\tools::input_body('property');

		$result = \lib\app\category\edit::edit($args, $id, $property);

		\content_b1\tools::say($result);
	}

}
?>
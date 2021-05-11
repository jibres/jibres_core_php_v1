<?php
namespace content_b1\tag\edit;


class model
{

	public static function put()
	{
		$id = \dash\request::get('id');
		$id = \dash\validate::id($id);

		$args             = [];
		$args['title']    = \dash\request::input_body('title');
		$args['slug']     = \dash\request::input_body('slug');
		$args['parent']   = \dash\request::input_body('parent');
		$args['desc']     = \dash\request::input_body('desc');
		$args['seotitle'] = \dash\request::input_body('seotitle');
		$args['seodesc']  = \dash\request::input_body('seodesc');

		$property  = \dash\request::input_body('property');

		$result = \lib\app\tag\edit::edit($args, $id, $property);

		\content_b1\tools::say($result);
	}

}
?>
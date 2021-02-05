<?php
namespace content_b1\ticket\edit;


class model
{


	public static function patch()
	{

		$args =	[];

		if(\dash\request::isset_input_body('content')) $args['content'] = \dash\request::input_body('content');
		if(\dash\request::isset_input_body('title')) $args['title'] = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('status')) $args['status'] = \dash\request::input_body('status');
		if(\dash\request::isset_input_body('solved')) $args['solved'] = \dash\request::input_body('solved');
		if(\dash\request::isset_input_body('content')) $args['content'] = \dash\request::input_body('content');


		$result = \dash\app\ticket\edit::edit($args, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>
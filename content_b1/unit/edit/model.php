<?php
namespace content_b1\unit\edit;


class model
{
	public static function patch()
	{
		$args                = [];
		$args['int']         = \content_b1\tools::input_body('int');
		$args['title']       = \content_b1\tools::input_body('title');

		$result = \lib\app\product\unit::edit($args, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}

}
?>
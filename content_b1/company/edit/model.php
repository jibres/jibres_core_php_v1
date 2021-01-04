<?php
namespace content_b1\company\edit;


class model
{
	public static function patch()
	{
		$args                = [];

		$args['title']       = \dash\request::input_body('title');

		$result = \lib\app\product\company::edit($args, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}

}
?>
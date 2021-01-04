<?php
namespace content_b1\posts\edit;


class model
{

	public static function patch()
	{
		$args = \content_b1\posts\add\model::get_args();

		$result = \dash\app\posts\edit::edit($args, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}

}
?>
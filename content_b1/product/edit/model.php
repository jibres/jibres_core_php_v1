<?php
namespace content_b1\product\edit;


class model
{
	public static function patch()
	{
		$post = \content_b1\product\add\model::get_post();

		$id = \dash\request::get('id');

		$result = \lib\app\product\edit::edit($post, $id);

		\content_b1\tools::say($result);

	}


}
?>
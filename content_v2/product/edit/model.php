<?php
namespace content_v2\product\edit;


class model
{
	public static function patch()
	{
		$post = \content_v2\product\add\model::get_post();

		$id = \dash\request::get('id');

		$result = \lib\app\product\edit::edit($post, $id);

		\content_v2\tools::say($result);

	}


}
?>
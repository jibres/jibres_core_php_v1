<?php
namespace content_v2\product\gallery;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$result = \content_a\products\edit\model::upload_gallery($id);

		\content_v2\tools::say($result);
	}
}
?>
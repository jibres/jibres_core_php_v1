<?php
namespace content_a\setting\product\category;


class model
{
	public static function post()
	{
		$post           = [];
		$post['tag'] = \dash\request::post('category');

		\lib\app\category\add::apply_to_all($post);



		\dash\redirect::pwd();
	}
}
?>
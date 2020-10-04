<?php
namespace content_a\setting\product\tag;


class model
{
	public static function post()
	{
		$post           = [];
		$post['tag'] = \dash\request::post('tag');

		\lib\app\product\tag::apply_to_all($post);

		\dash\redirect::pwd();
	}
}
?>
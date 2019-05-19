<?php
namespace content_subdomain\comment;

class model
{
	public static function post()
	{
		$post            = [];
		$post['product'] = \dash\request::post('product');
		$post['star']    = \dash\request::post('star');
		$post['content'] = \dash\request::post('content');

		$result = \lib\app\product\comment::add($post);
	}
}
?>
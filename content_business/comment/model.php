<?php
namespace content_business\comment;

class model
{
	public static function post()
	{
		$post               = [];
		$post['product_id'] = \dash\request::post('product_id');
		$post['star']       = \dash\request::post('rating');
		$post['content']    = \dash\request::post('content');
		$post['title']      = \dash\request::post('title');

		$post['name']       = \dash\request::post('name');
		$post['mobile']     = \dash\request::post('mobile');
		$post['username']   = \dash\request::post('username');


		$result = \lib\app\product\comment::add($post);
	}
}
?>
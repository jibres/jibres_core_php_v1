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
		$post['mobile']     = \dash\request::post('mobile');
		$post['post_id']    = \dash\request::post('post_id');
		$result             = \dash\app\comment\add::add($post);

	}
}
?>
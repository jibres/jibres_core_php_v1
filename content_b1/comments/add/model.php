<?php
namespace content_b1\comments\add;


class model
{

	public static function post()
	{
		$post                = [];
		$post['product_id']  = \dash\request::input_body('product_id');
		$post['star']        = \dash\request::input_body('rating');
		$post['displayname'] = \dash\request::input_body('name');
		$post['content']     = \dash\request::input_body('content');
		$post['title']       = \dash\request::input_body('title');
		$post['mobile']      = \dash\request::input_body('mobile');
		$post['post_id']     = \dash\request::input_body('post_id');
		$result              = \dash\app\comment\add::add($post);

		\content_b1\tools::say($result);
	}
}
?>
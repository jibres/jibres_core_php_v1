<?php
namespace content_b1\comments\edit;


class model
{

	public static function patch()
	{
		$post                = [];

		if(\dash\request::isset_input_body('product_id'))	 $post['product_id']  = \dash\request::input_body('product_id');
		if(\dash\request::isset_input_body('star'))			 $post['star']        = \dash\request::input_body('rating');
		if(\dash\request::isset_input_body('displayname'))	 $post['displayname'] = \dash\request::input_body('name');
		if(\dash\request::isset_input_body('content'))		 $post['content']     = \dash\request::input_body('content');
		if(\dash\request::isset_input_body('title'))		 $post['title']       = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('mobile'))		 $post['mobile']      = \dash\request::input_body('mobile');
		if(\dash\request::isset_input_body('status'))		 $post['status']      = \dash\request::input_body('status');
		if(\dash\request::isset_input_body('post_id'))		 $post['post_id']     = \dash\request::input_body('post_id');

		$result              = \dash\app\comment\edit::edit($post, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>
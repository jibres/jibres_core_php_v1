<?php
namespace content_b1\hashtag\edit;


class model
{

	public static function patch()
	{
		$post = [];

		if(\dash\request::isset_input_body('title'))	$post['title'] = \dash\request::input_body('title');
		if(\dash\request::isset_input_body('url'))		$post['url']   = \dash\request::input_body('url');

		$result              = \dash\app\terms\edit::edit($post, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>
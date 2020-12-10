<?php
namespace content_cms\posts\setting;

class model
{
	public static function post()
	{
		$posts = self::getPost();

		if(!$posts || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts\edit::edit($posts, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}




	public static function getPost()
	{
		$post = [];

		if(\dash\request::post('runaction_theme'))
		{
			$post['subtype'] = \dash\request::post('subtype');
		}

		if(\dash\request::post('runaction_comment'))
		{
			$post['comment'] = \dash\request::post('comment');
		}

		if(\dash\request::post('runaction_redirect'))
		{
			$post['redirecturl'] = \dash\request::post_raw('redirecturl');
		}

		if(\dash\request::post('runaction_publishdate'))
		{
			$post['publishdate'] = \dash\request::post('publishdate');
			$post['publishtime'] = \dash\request::post('publishtime');
		}

		if(\dash\request::post('runaction_postwriter'))
		{
			$post['creator'] = \dash\request::post('creator');
		}

		if(\dash\request::post('icon'))
		{
			$post['icon'] = \dash\request::post('icon');
		}


		return $post;

	}
}
?>

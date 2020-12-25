<?php
namespace content_cms\comments\edit;

class model
{
	public static function post()
	{

		$post                = [];
		$post['content']     = \dash\request::post('content');
		$post['title']       = \dash\request::post('title');
		$post['mobile']      = \dash\request::post('mobile');
		$post['displayname'] = \dash\request::post('displayname');
		$post['star']        = \dash\request::post('star');

		$post_detail = \dash\app\comment\edit::edit($post, \dash\request::get('cid'));

		if(\dash\engine\process::status())
		{

			\dash\redirect::to(\dash\url::this(). '/view'. \dash\request::full_get());
		}
	}
}
?>

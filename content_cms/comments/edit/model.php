<?php
namespace content_cms\comments\edit;

class model
{
	public static function post()
	{

		$post = [];
		$post['content'] = \dash\request::post('content');

		$post_detail = \dash\app\comment\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{

			\dash\redirect::to(\dash\url::this(). '/view'. \dash\request::full_get());
		}
	}
}
?>

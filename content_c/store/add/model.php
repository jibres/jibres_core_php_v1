<?php
namespace content_c\store\add;


class model
{
	public static function getPost()
	{
		$post              = [];
		$post['title']     = \dash\request::post('title');
		$post['subdomain'] = \dash\request::post('subdomain');
  		return $post;
	}


	public static function post()
	{
		$post = self::getPost();

		\lib\app\store\add::trial($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here());
		}
	}

}
?>

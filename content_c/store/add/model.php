<?php
namespace content_c\store\add;


class model
{
	public static function getPost()
	{
		$post           = [];
		$post['name']   = \dash\request::post('name');
		$post['slug']   = \dash\request::post('slug');
		$post['plan']   = 'trial';
		// $post['period'] = \dash\request::post('period');
		// $post['bank']   = \dash\request::post('bank');
		// $post['promo']  = \dash\request::post('promo');

  		return $post;
	}


	public static function post()
	{
		$post = self::getPost();

		\lib\app\store::before_add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here().'/store');
		}
	}

}
?>

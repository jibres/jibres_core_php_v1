<?php
namespace content_i\jib\add;

class model
{
	public static function post()
	{
		$post              = [];

		$post['bank']      = \dash\request::post('bank');
		$post['title']     = \dash\request::post('title');
		$post['isdefault'] = \dash\request::post('isdefault');
		$post['desc']      = \dash\request::post('desc');

		\lib\app\jib::add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>
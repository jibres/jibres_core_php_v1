<?php
namespace content_i\jib\edit;


class model
{
	public static function post()
	{

		$post              = [];
		$post['bank']      = \dash\request::post('bank');
		$post['isdefault'] = \dash\request::post('isdefault');
		$post['title']     = \dash\request::post('title');
		$post['desc']      = \dash\request::post('desc');

		\lib\app\jib::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>
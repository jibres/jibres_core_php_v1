<?php
namespace content_i\checkbook\edit;


class model
{
	public static function post()
	{

		$post                = [];
		$post['bank']        = \dash\request::post('bank');
		$post['desc']        = \dash\request::post('desc');
		$post['firstserial'] = \dash\request::post('firstserial');
		$post['number']      = \dash\request::post('number');
		$post['pagecount']   = \dash\request::post('pagecount');
		$post['title']       = \dash\request::post('title');

		\lib\app\checkbook::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>
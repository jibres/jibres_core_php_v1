<?php
namespace content_i\inout\edit;


class model
{
	public static function post()
	{

		$post               = [];
		$post['cat']        = \dash\request::post('cat');
		$post['date']       = \dash\request::post('date');
		$post['desc']       = \dash\request::post('desc');
		$post['jib']        = \dash\request::post('jib');
		$post['thirdparty'] = \dash\request::post('thirdparty');
		$post['time']       = \dash\request::post('time');
		$post['isplus']     = \dash\request::post('isplus');
		$post['price']      = \dash\request::post('price');
		$post['discount']   = \dash\request::post('discount');

		\lib\app\inout::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>
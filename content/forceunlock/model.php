<?php
namespace content\forceunlock;


class model
{
	public static function post()
	{
		if(\dash\request::post('unlock') === 'unlock')
		{
			\dash\engine\lock::unlock();
			\dash\redirect::to(\dash\url::kingdom());
		}
	}
}
?>
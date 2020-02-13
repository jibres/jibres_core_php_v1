<?php
namespace content\emergencydomain;


class model
{
	public static function post()
	{
		if(\dash\request::post('emergencydomain') === 'emergencydomain')
		{
			\dash\utility\cookie::write('emergencydomain', 'ok');
			\dash\redirect::to(\dash\url::kingdom());
		}
	}
}
?>
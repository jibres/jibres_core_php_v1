<?php
namespace content_a\products\home;


class model
{
	public static function post()
	{
		if(\dash\request::post('add_from') === 'ganje' && \dash\request::post('ganje_id'))
		{
			$result = \lib\app\product\ganje::add_from_id(\dash\request::post('ganje_id'));

			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
			}
		}
	}
}
?>
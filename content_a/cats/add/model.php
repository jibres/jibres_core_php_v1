<?php
namespace content_a\cats\add;


class model
{
	public static function post()
	{
		$args                = [];
		$args['title']       = \dash\request::post('cat');

		$result = \lib\app\product\cat::add($args);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}
}
?>
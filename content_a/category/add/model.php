<?php
namespace content_a\category\add;


class model
{
	public static function post()
	{
		$args           = [];
		$args['title']  = \dash\request::post('cat');
		$args['parent'] = \dash\request::post('parent');

		$result = \lib\app\category\add::add($args);

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
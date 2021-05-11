<?php
namespace content_a\tag\add;


class model
{
	public static function post()
	{
		$args           = [];
		$args['title']  = \dash\request::post('tag');

		$result = \lib\app\tag\add::add($args);

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
<?php
namespace content_cms\category\add;


class model
{
	public static function post()
	{
		$args          = [];
		$args['title'] = \dash\request::post('title');
		$args['type']  = 'cat';

		$result = \dash\app\terms\add::add($args);

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
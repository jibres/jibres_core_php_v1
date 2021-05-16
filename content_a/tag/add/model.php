<?php
namespace content_a\tag\add;


class model
{
	public static function post()
	{
		$args           = [];
		$args['title']  = \dash\request::post('tag');
		$args['showonwebsite'] = \dash\request::get('firstlevel') ? 1 : null;

		$result = \lib\app\tag\add::add($args);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				if($args['showonwebsite'])
				{
					\dash\redirect::to(\dash\url::this(). '/sort?id='. $result['id']);
				}
				else
				{
					\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
				}
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}
}
?>
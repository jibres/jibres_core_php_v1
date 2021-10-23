<?php
namespace content_a\category\add;


class model
{
	public static function post()
	{
		$args           = [];
		$args['title']  = \dash\request::post('category');
		$args['firstlevel'] = \dash\request::get('firstlevel') ? 1 : null;

		$result = \lib\app\tag\add::add($args);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				if($args['firstlevel'])
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
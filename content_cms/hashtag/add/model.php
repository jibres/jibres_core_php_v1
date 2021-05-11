<?php
namespace content_cms\hashtag\add;


class model
{
	public static function post()
	{
		$args           = [];
		$args['title']  = \dash\request::post('title');
		$args['type']  = 'tag';

		$result = \dash\app\terms\add::add($args);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				\dash\notif::ok(T_("Tag added"));
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
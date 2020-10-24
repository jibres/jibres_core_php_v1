<?php
namespace content_a\form\tag\add;


class model
{
	public static function post()
	{
		$args           = [];
		$args['title']  = \dash\request::post('tag');

		$result = \lib\app\form\tag\add::add($args);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::that(). '/edit?tid='. $result['id']. '&id='. \dash\request::get('id'));
			}
			else
			{
				\dash\redirect::to(\dash\url::that(). \dash\request::fix_get(null, true));
			}
		}
	}
}
?>
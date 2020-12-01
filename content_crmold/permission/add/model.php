<?php
namespace content_crm\permission\add;


class model
{
	public static function post()
	{
		$post          = [];
		$post['title'] = \dash\request::post('title');

		$result = \dash\app\permission\add::add($post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
		}


	}
}
?>
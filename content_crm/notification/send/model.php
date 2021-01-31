<?php
namespace content_crm\notification\send;


class model
{
	public static function post()
	{
		$post         = [];
		$post['user'] = \dash\request::post('user');
		$post['text'] = \dash\request::post('text');

		$result = \dash\app\log\add::notif_once($post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='. $result['id']);
		}

		\dash\redirect::pwd();


	}
}
?>

<?php
namespace content_crm\sms\send;


class model
{
	public static function post()
	{
		$post            = [];
		$post['mobile']  = \dash\request::post('mobile');
		$post['message'] = \dash\request::post('message');
		$post['sender']  = 'admin';

		$result = \lib\app\sms\queue::add_one($post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='. $result['id']);
		}


	}
}
?>

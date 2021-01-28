<?php
namespace content_crm\sms\send;


class model
{
	public static function post()
	{
		$post            = [];
		$post['mobile']  = \dash\request::post('mobile');
		$post['message'] = \dash\request::post('message');

		$result = \lib\app\sms\send::send_once($post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='. $result['id']);
		}


	}
}
?>

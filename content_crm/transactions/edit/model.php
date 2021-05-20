<?php
namespace content_crm\transactions\edit;

class model
{
	public static function post()
	{

		$id = \dash\request::get('id');

		$post           = [];
		$post['title']  = \dash\request::post('title');
		$post['amount'] = \dash\request::post('amount');
		$post['date']   = \dash\request::post('date');
		$post['time']   = \dash\request::post('time');
		$post['verify'] = \dash\request::post('verify');

		$result = \dash\app\transaction\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/detail'. \dash\request::full_get(['id' => \dash\request::get('id')]));
		}
	}
}
?>
<?php
namespace content_api\v6\store;


class controller
{
	public static function routing()
	{
		\content_api\v6\access::check_appkey();

		\content_api\v6\access::user();

		$detail    = [];

		$directory = \dash\url::directory();

		if($directory === 'v6/store/add')
		{
			if(\dash\request::is('post'))
			{
				$detail = self::new_store();
			}
			else
			{
				\content_api\v6::no(400);
			}
		}
		else
		{
			\content_api\v6::no(404);
		}

		\content_api\v6::bye($detail);
	}



	private static function new_store()
	{
		$post              = [];
		$post['title']     = \dash\request::post('title');
		$post['subdomain'] = \dash\request::post('subdomain');
		$post['answer']    = \dash\request::post('answer');

		$result = \lib\app\store\add::trial($post);

		if(isset($result['store_id']))
		{
			unset($result['store_id']);
		}

		return $result;
	}
}
?>
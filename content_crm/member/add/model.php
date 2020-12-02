<?php
namespace content_crm\member\add;


class model
{

	public static function getPost()
	{
		$post =
		[
			'mobile'      => \dash\request::post('mobile'),
			'displayname'      => \dash\request::post('displayname'),
		];

		return $post;
	}


	public static function post()
	{
		// ready request
		$request = self::getPost();

		$result = \dash\app\user::add($request);

		if(\dash\engine\process::status())
		{
			if(isset($result['user_id']))
			{
				\dash\redirect::to(\dash\url::here(). '/member/glance?id='. $result['user_id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::here(). '/member');
			}
		}
	}
}
?>
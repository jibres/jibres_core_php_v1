<?php
namespace content_crm\staff\add;


class model
{

	public static function getPost()
	{
		$post =
		[
			'mobile'      => \dash\request::post('mobile'),
			'displayname' => \dash\request::post('displayname'),
			'permission'  => \dash\request::post('permission'),
		];

		if(!$post['mobile'])
		{
			\dash\notif::error(T_("Mobile is required"), 'mobile');
			return false;
		}

		if(!$post['displayname'])
		{
			\dash\notif::error(T_("Name is required"), 'displayname');
			return false;
		}

		if(!$post['permission'])
		{
			\dash\notif::error(T_("Permission is required"), 'permission');
			return false;
		}

		return $post;
	}


	public static function post()
	{
		// ready request
		$request = self::getPost();
		if(!$request)
		{
			return false;
		}

		$result = \dash\app\user::add($request);

		if(\dash\engine\process::status())
		{
			if(isset($result['user_id']))
			{
				\dash\redirect::to(\dash\url::here(). '/member/glance?id='. $result['user_id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::here(). '/staff');
			}
		}
	}
}
?>
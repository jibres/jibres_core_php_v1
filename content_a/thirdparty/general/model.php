<?php
namespace content_a\thirdparty\general;


class model
{
	public static function getPost()
	{
		$post                = [];
		$post['mobile']      = \dash\request::post('mobile');
		$post['displayname'] = \dash\request::post('displayname');
		$post['gender']      = \dash\request::post('gender');
		$post['phone']       = \dash\request::post('phone');
		$post['fax']         = \dash\request::post('fax');
		$post['email']       = \dash\request::post('email');
		return $post;
	}

	public static function post()
	{
		$request = self::getPost();

		\lib\app\thirdparty::edit($request, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>

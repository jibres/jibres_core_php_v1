<?php
namespace content_a\thirdparty\manage;


class model
{
	public static function getPost()
	{
		$post             = [];

		if(\dash\permission::check('thirdpartyTypeEdit'))
		{
			$post['staff']    = \dash\request::post('staff');
			$post['status']   = \dash\request::post('status');
			$post['customer'] = \dash\request::post('customer');
			$post['supplier'] = \dash\request::post('supplier');
		}

		if(\dash\permission::check('thirdpartyPermissionEdit'))
		{
			$post['permission'] = \dash\request::post('permission');
		}

		return $post;
	}


	public static function post()
	{

		\lib\app\thirdparty::edit(self::getPost(), \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

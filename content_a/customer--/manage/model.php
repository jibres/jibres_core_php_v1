<?php
namespace content_a\customer\manage;


class model
{
	public static function getPost()
	{
		$post             = [];

		if(\dash\permission::check('customerTypeEdit'))
		{
			$post['staff']    = \dash\request::post('staff');
			$post['status']   = \dash\request::post('status');
			$post['customer'] = \dash\request::post('customer');
			$post['supplier'] = \dash\request::post('supplier');
		}

		if(\dash\permission::check('customerPermissionEdit'))
		{
			$post['permission'] = \dash\request::post('permission');
		}

		return $post;
	}


	public static function post()
	{

		\lib\app\customer::edit(self::getPost(), \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

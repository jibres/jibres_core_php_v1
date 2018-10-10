<?php
namespace content_a\thirdparty\manage;


class model
{
	public static function getPost()
	{
		$post             = [];
		$post['staff']    = \dash\request::post('staff');
		$post['customer'] = \dash\request::post('customer');
		$post['supplier'] = \dash\request::post('supplier');
		$post['permission'] = \dash\request::post('permission');

		return $post;
	}


	public static function post()
	{
		\dash\permission::access('aThirdPartyEdit');

		\lib\app\thirdparty::edit(self::getPost(), \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

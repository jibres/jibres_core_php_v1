<?php
namespace content_a\thirdparty\company;


class model
{
	public static function getPost()
	{
		\dash\permission::access('thirdpartyCompanyDetailEdit');

		$post                          = [];
		$post['companyname']           = \dash\request::post('companyname');
		$post['companyeconomiccode']   = \dash\request::post('companyeconomiccode');
		$post['companynationalid']     = \dash\request::post('companynationalid');
		$post['companyregisternumber'] = \dash\request::post('companyregisternumber');
		$post['companytel']            = \dash\request::post('companytel');
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

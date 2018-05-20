<?php
namespace content_a\thirdparty\identification;


class model
{
	public static function getPost()
	{
		$post                 = [];
		$post['shfrom']       = \dash\request::post('shfrom');
		$post['birthcity']    = \dash\request::post('birthcity');
		$post['shcode']       = \dash\request::post('shcode');
		$post['pasportcode']  = \dash\request::post('pasportcode');
		$post['pasportdate']  = \dash\request::post('pasportdate');
		$post['nationalcode'] = \dash\request::post('nationalcode');
		$post['father']       = \dash\request::post('father');

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

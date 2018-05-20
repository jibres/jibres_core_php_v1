<?php
namespace content_a\thirdparty\address;


class model
{
	public static function getPost()
	{
		$post             = [];
		$post['country']  = \dash\request::post('country');
		$post['province'] = \dash\request::post('province');
		$post['city']     = \dash\request::post('city');
		$post['zipcode']  = \dash\request::post('zipcode');
		$post['address']  = \dash\request::post('address');
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

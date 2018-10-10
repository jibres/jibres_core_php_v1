<?php
namespace content_a\thirdparty\identify;


class model
{
	public static function getPost()
	{
		$post                 = [];
		$post['gender']       = \dash\request::post('gender');
		$post['displayname']  = \dash\request::post('displayname');
		$post['firstname']    = \dash\request::post('name');
		$post['lastname']     = \dash\request::post('lastName');
		$post['father']       = \dash\request::post('father');
		$post['birthday']     = \dash\request::post('birthday');
		$post['nationality']  = \dash\request::post('nationality');
		$post['nationalcode'] = \dash\request::post('nationalcode');
		$post['marital']      = \dash\request::post('marital');
		$post['shcode']       = \dash\request::post('shcode');
		$post['birthcity']    = \dash\request::post('birthcity');
		$post['pasportcode']  = \dash\request::post('pasportcode');

		$nationalthumb = \dash\app\file::upload_quick('nationalthumb');
		if($nationalthumb)
		{
			$post['nationalthumb'] = $nationalthumb;
		}

		$shthumb = \dash\app\file::upload_quick('shthumb');
		if($shthumb)
		{
			$post['shthumb'] = $shthumb;
		}

		$passportthumb = \dash\app\file::upload_quick('passportthumb');
		if($passportthumb)
		{
			$post['passportthumb'] = $passportthumb;
		}

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

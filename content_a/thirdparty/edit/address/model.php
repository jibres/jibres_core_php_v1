<?php
namespace content_a\thirdparty\edit\address;


class model extends \content_a\main\model
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


	public function post_address($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \dash\request::get('id'));

		if(\lib\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

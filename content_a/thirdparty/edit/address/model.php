<?php
namespace content_a\thirdparty\edit\address;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post             = [];
		$post['country']  = \lib\request::post('country');
		$post['province'] = \lib\request::post('province');
		$post['city']     = \lib\request::post('city');
		$post['zipcode']  = \lib\request::post('zipcode');
		$post['address']  = \lib\request::post('address');
		return $post;
	}


	public function post_address($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \lib\request::get('id'));

		if(\lib\debug::$status)
		{
			\lib\redirect::pwd();
		}
	}
}
?>

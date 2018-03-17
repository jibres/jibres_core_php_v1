<?php
namespace content_a\thirdparty\edit\identification;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post                 = [];
		$post['shfrom']       = \lib\request::post('shfrom');
		$post['birthcity']    = \lib\request::post('birthcity');
		$post['shcode']       = \lib\request::post('shcode');
		$post['pasportcode']  = \lib\request::post('pasportcode');
		$post['pasportdate']  = \lib\request::post('pasportdate');
		$post['nationalcode'] = \lib\request::post('nationalcode');
		$post['father']       = \lib\request::post('father');

		return $post;
	}


	public function post_identification($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \lib\request::get('id'));

		if(\lib\debug::$status)
		{
			\lib\redirect::pwd();
		}
	}
}
?>

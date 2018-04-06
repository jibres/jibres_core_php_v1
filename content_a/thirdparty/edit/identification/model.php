<?php
namespace content_a\thirdparty\edit\identification;


class model extends \content_a\main\model
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


	public function post_identification($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \dash\request::get('id'));

		if(\lib\engine\process::status())
		{
			\lib\redirect::pwd();
		}
	}
}
?>

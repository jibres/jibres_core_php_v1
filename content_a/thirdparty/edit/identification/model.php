<?php
namespace content_a\thirdparty\edit\identification;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post                 = [];
		$post['shfrom']       = \lib\utility::post('shfrom');
		$post['birthcity']    = \lib\utility::post('birthcity');
		$post['shcode']       = \lib\utility::post('shcode');
		$post['pasportcode']  = \lib\utility::post('pasportcode');
		$post['pasportdate']  = \lib\utility::post('pasportdate');
		$post['nationalcode'] = \lib\utility::post('nationalcode');
		$post['father']       = \lib\utility::post('father');

		return $post;
	}


	public function post_identification($_args)
	{
		\lib\app\thirdparty::edit(self::getPost(), \lib\utility::get('id'));

		if(\lib\debug::$status)
		{
			$this->redirector(\lib\url::pwd());
		}
	}
}
?>

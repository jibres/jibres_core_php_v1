<?php
namespace content_a\supplier\edit\identification;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post                   = [];
		$post['birthplace']     = \lib\utility::post('birthplace');
		$post['issueplace']     = \lib\utility::post('issueplace');
		$post['shcode']         = \lib\utility::post('shcode');
		$post['passportcode']   = \lib\utility::post('passport');
		$post['passportexpire'] = \lib\utility::post('passportexpire');
		$post['nationalcode']   = \lib\utility::post('nationalcode');
		$post['father']         = \lib\utility::post('father');
		$post['id']             = \lib\utility::get('id');

		return $post;
	}


	public function post_identification($_args)
	{

		\lib\app\supplier::edit(self::getPost());

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>

<?php
namespace content_c\store\add;


class model extends \content_c\main\model
{
	public static function getPost()
	{
		$post         = [];
		$post['name'] = \lib\utility::post('name');
		$post['slug'] = \lib\utility::post('slug');
		$post['desc'] = \lib\utility::post('desc');

  		return $post;
	}


	public function post_add()
	{
		\lib\app\store::add(self::getPost());

		if(\lib\debug::$status)
		{
			$this->redirector(\lib\url::here().'/store');
		}
	}
}
?>

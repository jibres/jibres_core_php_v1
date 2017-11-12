<?php
namespace content_a\setting\general;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$args =
		[
			'name'    => \lib\utility::post('name'),
			'website' => \lib\utility::post('website'),
			'desc'    => \lib\utility::post('desc'),
			// 'slug' => \lib\utility::post('slug'),
		];
		return $args;
	}


	public function post_general($_args)
	{
		\lib\app\store::edit(self::getPost());

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>
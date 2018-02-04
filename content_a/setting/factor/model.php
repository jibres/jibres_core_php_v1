<?php
namespace content_a\setting\factor;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$args =
		[
			'name'    => \lib\utility::post('name'),
			'website' => \lib\utility::post('website'),
			'desc'    => \lib\utility::post('desc'),
			'mobile'  => \lib\utility::post('mobile'),
			'address' => \lib\utility::post('address'),
			'phone'   => \lib\utility::post('phone'),
		];
		return $args;
	}


	public function post_factor($_args)
	{
		\lib\app\store::edit(self::getPost());

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>
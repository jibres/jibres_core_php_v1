<?php
namespace content_a\staff\general;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$post =
		[
			'firstname'      => \lib\utility::post('name'),
			'lastname'       => \lib\utility::post('lastName'),
			'nationalcode'   => \lib\utility::post('nationalcode'),
			'father'         => \lib\utility::post('father'),
			'birthday'       => \lib\utility::post('birthday'),
			'gender'         => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
			// 'grade'          => \lib\utility::post('grade'),
		];

		return $post;
	}


	public function post_general($_args)
	{
		$request       = self::getPost();
		$request['id'] = \lib\utility::get('id');

		\lib\app\staff::edit($request);

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('baseFull'). '/'. \lib\router::get_url());
		}
	}
}
?>
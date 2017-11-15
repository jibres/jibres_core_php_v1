<?php
namespace content_a\customer\edit\general;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post =
		[
			'mobile'       => \lib\utility\filter::mobile(\lib\utility::post('mobile')),
			'firstname'    => \lib\utility::post('name'),
			'lastname'     => \lib\utility::post('lastName'),
			'nationalcode' => \lib\utility::post('nationalcode'),
			'phone'        => \lib\utility::post('phone'),
			'address'      => \lib\utility::post('address'),
			'desc'         => \lib\utility::post('desc'),
			'code'         => \lib\utility::post('code'),
			'gender'       => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
		];

		return $post;
	}


	public function post_general($_args)
	{
		$request       = self::getPost();
		$request['id'] = \lib\utility::get('id');

		\lib\app\customer::edit($request);

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>

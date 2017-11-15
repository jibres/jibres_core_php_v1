<?php
namespace content_a\supplier\edit\general;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$post =
		[
			'firstname' => \lib\utility\filter::mobile(\lib\utility::post('visitormobile')),
			'lastname'  => \lib\utility::post('visitorname'),
			'father'    => \lib\utility::post('company'),
			'desc'      => \lib\utility::post('desc'),
			'gender'    => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
		];

		return $post;
	}


	public function post_general($_args)
	{
		$request       = self::getPost();
		$request['id'] = \lib\utility::get('id');

		\lib\app\supplier::edit($request);

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>

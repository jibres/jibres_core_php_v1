<?php
namespace content_a\thirdparty\edit\general;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$thirdparty             = \lib\app\thirdparty::get(\lib\utility::get('id'));
		if(isset($thirdparty['supplier']) || (isset($thirdparty['type']) && $thirdparty['type'] === 'supplier'))
		{
			$post =
			[
				'type'          => 'supplier',
				'visitorname'   => \lib\utility::post('visitorname'),
				'visitormobile' => \lib\utility::post('visitormobile'),
				'company'       => \lib\utility::post('company'),
			];
		}
		else
		{
			$post =
			[
				'mobile'       => \lib\utility\filter::mobile(\lib\utility::post('mobile')),
				'firstname'    => \lib\utility::post('name'),
				'lastname'     => \lib\utility::post('lastName'),
				'nationalcode' => \lib\utility::post('nationalcode'),
				'birthday'     => \lib\utility::post('birthday'),
				'gender'       => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
			];
		}

		return $post;
	}


	public function post_general($_args)
	{
		$request       = self::getPost();

		\lib\app\thirdparty::edit($request, \lib\utility::get('id'));

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>

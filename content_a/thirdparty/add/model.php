<?php
namespace content_a\thirdparty\add;


class model extends \content_a\main\model
{
	public static function getPostthirdparty()
	{
		if(\lib\utility::get('type') === 'supplier')
		{
			$post =
			[
				'type'          => \lib\utility::get('type'),
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
				'type'         => \lib\utility::get('type'),
				'firstname'    => \lib\utility::post('name'),
				'lastname'     => \lib\utility::post('lastName'),
				'nationalcode' => \lib\utility::post('nationalcode'),
				'father'       => \lib\utility::post('father'),
				'birthday'     => \lib\utility::post('birthday'),
				'gender'       => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
			];

		}

		return $post;
	}


	public function post_thirdparty_add()
	{
		// ready request
		$request = self::getPostthirdparty();

		\lib\app\thirdparty::add($request);

		if(\lib\debug::$status)
		{
			if(isset($result['user_id']))
			{
				$this->redirector($this->url('base'). '/a/thirdparty/edit='. $result['user_id']);
			}
			else
			{
				$this->redirector($this->url('base'). '/a/thirdparty');
			}
		}
	}
}
?>

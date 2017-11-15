<?php
namespace content_a\supplier\add;


class model extends \content_a\main\model
{
	public static function getPostsupplier()
	{
		$post =
		[
			'mobile'       => \lib\utility\filter::mobile(\lib\utility::post('mobile')),
			'firstname'    => \lib\utility::post('name'),
			'lastname'     => \lib\utility::post('lastName'),
			'nationalcode' => \lib\utility::post('nationalcode'),
			'father'       => \lib\utility::post('father'),
			'birthday'     => \lib\utility::post('birthday'),
			'gender'       => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
		];

		$post['type']  = 'supplier';

		return $post;
	}


	public function post_supplier_add()
	{
		// ready request
		$request = self::getPostsupplier();

		if(!$request['firstname'] && !$request['lastname'])
		{
			\lib\debug::error(T_("Fill name or family is require!"));
			return false;
		}

		\lib\app\supplier::add($request);

		if(\lib\debug::$status)
		{
			if(isset($result['user_id']))
			{
				$this->redirector($this->url('base'). '/a/supplier/edit='. $result['user_id']);
			}
			else
			{
				$this->redirector($this->url('base'). '/a/supplier');
			}
		}
	}
}
?>

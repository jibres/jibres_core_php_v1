<?php
namespace content_a\supplier\add;


class model extends \content_a\main\model
{
	public static function getPostsupplier()
	{
		$post =
		[
			'nationalcode' => \lib\utility\filter::mobile(\lib\utility::post('visitormobile')),
			'lastname'     => \lib\utility::post('company'),
			'father'       => \lib\utility::post('visitorname'),
			'desc'         => \lib\utility::post('desc'),
			'gender'       => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
		];

		$post['type']  = 'supplier';

		return $post;
	}


	public function post_supplier_add()
	{
		// ready request
		$request = self::getPostsupplier();

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

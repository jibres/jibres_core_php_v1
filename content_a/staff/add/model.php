<?php
namespace content_a\staff\add;


class model extends \content_a\main\model
{
	public static function getPoststaff()
	{
		$post =
		[
			'firstname'    => \lib\utility::post('name'),
			'lastname'     => \lib\utility::post('lastName'),
			'nationalcode' => \lib\utility::post('nationalcode'),
			'father'       => \lib\utility::post('father'),
			'birthday'     => \lib\utility::post('birthday'),
			'gender'       => \lib\utility::post('gender') === 'on' ? 'female' : 'male',
		];

		$post['type']  = 'staff';

		return $post;
	}


	public function post_staff_add()
	{
		// ready request
		$request = self::getPoststaff();

		if(!$request['firstname'] && !$request['lastname'])
		{
			\lib\debug::error(T_("Fill name or family is require!"));
			return false;
		}

		\lib\app\staff::add($request);

		if(\lib\debug::$status)
		{
			if(isset($result['user_id']))
			{
				$this->redirector($this->url('base'). '/a/staff/edit='. $result['user_id']);
			}
			else
			{
				$this->redirector($this->url('base'). '/a/staff');
			}
		}
	}
}
?>
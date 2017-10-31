<?php
namespace content_a\staff\add;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
{
	/**
	 * Gets the post staff.
	 *
	 * @return     array  The post staff.
	 */
	public static function getPoststaff()
	{
		$post =
		[
			'firstname'      => utility::post('name'),
			'lastname'       => utility::post('lastName'),
			'nationalcode'   => utility::post('nationalcode'),
			'father'         => utility::post('father'),
			'birthday'       => utility::post('birthday'),
			'gender'         => utility::post('gender') === 'on' ? 'female' : 'male',
		];

		$post['type']  = 'staff';

		return $post;
	}


	/**
	 * Posts a staff add.
	 */
	public function post_staff_add()
	{
		// ready request
		$request = self::getPoststaff();

		if(!$request['firstname'] && !$request['lastname'])
		{
			debug::error(T_("Fill name or family is require!"));
			return false;
		}

		\lib\app\staff::add($request);

		if(debug::$status)
		{
			if(isset($result['user_id']))
			{
				$this->redirector($this->url('base'). '/s/staff/edit='. $result['user_id']);
			}
			else
			{
				$this->redirector($this->url('base'). '/s/staff');
			}
		}
	}
}
?>
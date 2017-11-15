<?php
namespace content_a\customer\add;


class model extends \content_a\main\model
{
	public static function getPostcustomer()
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

		$post['type']  = 'customer';

		return $post;
	}


	public function post_customer_add()
	{
		// ready request
		$request = self::getPostcustomer();

		if(!$request['firstname'] && !$request['lastname'])
		{
			\lib\debug::error(T_("Fill name or family is require!"));
			return false;
		}

		\lib\app\customer::add($request);

		if(\lib\debug::$status)
		{
			if(isset($result['user_id']))
			{
				$this->redirector($this->url('base'). '/a/customer/edit='. $result['user_id']);
			}
			else
			{
				$this->redirector($this->url('base'). '/a/customer');
			}
		}
	}
}
?>

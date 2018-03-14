<?php
namespace content_a\thirdparty\add;


class model extends \content_a\main\model
{
	public static function getPostthirdparty()
	{
		$post         = [];
		$post['type'] = \lib\utility::get('type');

		if(\lib\utility::get('type') === 'supplier')
		{
			$post['visitorname']   = \lib\utility::post('visitorname');
			$post['visitormobile'] = \lib\utility::post('visitormobile');
			$post['company']       = \lib\utility::post('company');
		}
		else
		{

			$post['mobile']       = \lib\utility\filter::mobile(\lib\utility::post('mobile'));
			$post['type']         = \lib\utility::get('type');
			$post['firstname']    = \lib\utility::post('name');
			$post['lastname']     = \lib\utility::post('lastName');
			$post['nationalcode'] = \lib\utility::post('nationalcode');
			$post['gender']       = \lib\utility::post('gender') === 'on' ? 'female' : 'male';

			if(\lib\utility::get('type') === 'staff')
			{
				$post['birthday']  = \lib\utility::post('birthday');
			}
			else
			{
				$post['code']    = \lib\utility::post('code');
				$post['address'] = \lib\utility::post('address');
				$post['phone']   = \lib\utility::post('phone');
				$post['desc']    = \lib\utility::post('desc');
			}
		}

		return $post;
	}


	public function post_thirdparty_add()
	{
		// ready request
		$request = self::getPostthirdparty();

		$result = \lib\app\thirdparty::add($request);

		if(\lib\debug::$status)
		{
			if(isset($result['thirdparty_id']))
			{
				$this->redirector(\lib\url::base(). '/a/thirdparty/edit?id='. $result['thirdparty_id']);
			}
			else
			{
				$this->redirector(\lib\url::base(). '/a/thirdparty');
			}
		}
	}
}
?>

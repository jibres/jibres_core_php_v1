<?php
namespace content_a\thirdparty\add;


class model extends \content_a\main\model
{
	public static function getPostthirdparty()
	{
		$post         = [];
		$post['type'] = \lib\request::get('type');

		if(\lib\request::get('type') === 'supplier')
		{
			$post['visitorname']   = \lib\request::post('visitorname');
			$post['visitormobile'] = \lib\request::post('visitormobile');
			$post['company']       = \lib\request::post('company');
		}
		else
		{

			$post['mobile']       = \lib\utility\filter::mobile(\lib\request::post('mobile'));
			$post['type']         = \lib\request::get('type');
			$post['firstname']    = \lib\request::post('name');
			$post['lastname']     = \lib\request::post('lastName');
			$post['nationalcode'] = \lib\request::post('nationalcode');
			$post['gender']       = \lib\request::post('gender') === 'on' ? 'female' : 'male';

			if(\lib\request::get('type') === 'staff')
			{
				$post['birthday']  = \lib\request::post('birthday');
			}
			else
			{
				$post['code']    = \lib\request::post('code');
				$post['address'] = \lib\request::post('address');
				$post['phone']   = \lib\request::post('phone');
				$post['desc']    = \lib\request::post('desc');
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

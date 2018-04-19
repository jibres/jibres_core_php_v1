<?php
namespace content_a\thirdparty\add;


class model
{
	public static function post()
	{
		// ready request
		$request = self::getPostthirdparty();

		$result = \lib\app\thirdparty::add($request);

		if(\dash\engine\process::status())
		{
			if(isset($result['thirdparty_id']))
			{
				\dash\redirect::to(\dash\url::base(). '/a/thirdparty/general?id='. $result['thirdparty_id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::base(). '/a/thirdparty');
			}
		}
	}


	public static function getPostthirdparty()
	{
		$post         = [];
		$post['type'] = \dash\request::get('type');

		if(\dash\request::get('type') === 'supplier')
		{
			$post['visitorname']   = \dash\request::post('visitorname');
			$post['visitormobile'] = \dash\request::post('visitormobile');
			$post['company']       = \dash\request::post('company');
		}
		else
		{

			$post['mobile']       = \dash\utility\filter::mobile(\dash\request::post('mobile'));
			$post['type']         = \dash\request::get('type');
			$post['firstname']    = \dash\request::post('name');
			$post['lastname']     = \dash\request::post('lastName');
			$post['nationalcode'] = \dash\request::post('nationalcode');
			$post['gender']       = \dash\request::post('gender') === 'on' ? 'female' : 'male';

			if(\dash\request::get('type') === 'staff')
			{
				$post['birthday']  = \dash\request::post('birthday');
			}
			else
			{
				$post['code']    = \dash\request::post('code');
				$post['address'] = \dash\request::post('address');
				$post['phone']   = \dash\request::post('phone');
				$post['desc']    = \dash\request::post('desc');
			}
		}

		return $post;
	}
}
?>

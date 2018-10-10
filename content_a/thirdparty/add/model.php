<?php
namespace content_a\thirdparty\add;


class model
{

	public static function getPostthirdparty()
	{
		$post                = [];
		$post['type']        = \dash\request::get('type');
		$post['mobile']      = \dash\request::post('mobile');
		$post['displayname'] = \dash\request::post('displayname');
		$post['gender']      = \dash\request::post('gender');

		if(\dash\request::get('type') === 'supplier')
		{
			$post['companyname'] = \dash\request::post('companyname');
		}
		elseif(\dash\request::get('type') === 'staff')
		{
			$post['firstname']   = \dash\request::post('name');
			$post['lastname']    = \dash\request::post('lastName');
			$post['displayname'] = trim($post['firstname']. ' '. $post['lastname']);
		}

		return $post;
	}


	public static function post()
	{
		// ready request
		$request = self::getPostthirdparty();

		$result = \lib\app\thirdparty::add($request);

		if(\dash\engine\process::status())
		{
			if(isset($result['thirdparty_id']))
			{
				\dash\redirect::to(\dash\url::this(). '/glance?id='. $result['thirdparty_id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}


}
?>

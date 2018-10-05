<?php
namespace content_a\thirdparty\add;


class model
{
	public static function post()
	{
		\dash\permission::access('aThirdPartyAdd');

		$mobile = \dash\request::post('mobile');
		$mobile = \dash\coding::decode($mobile);
		if($mobile)
		{
			$check = \lib\db\userstores::get(['id' => intval($mobile), 'store_id' => \lib\store::id(), 'limit' => 1]);
			if(isset($check['id']))
			{
				$url = \dash\url::this(). '/general?id='. \dash\coding::encode($check['id']);
				\dash\redirect::to($url);
				return;
			}
		}

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
		$post              = [];
		$post['type']      = \dash\request::get('type');
		$post['mobile']    = \dash\request::post('mobile');
		$post['gender']    = \dash\request::post('gender');
		$post['firstname'] = \dash\request::post('name');
		$post['lastname']  = \dash\request::post('lastName');

		if(\dash\request::get('type') === 'supplier')
		{
			$post['companyname'] = \dash\request::post('companyname');
			$post['displayname'] = \dash\request::post('companyname');
		}

		return $post;
	}
}
?>

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
				\dash\redirect::to(\dash\url::this(). '/general?id='. $result['thirdparty_id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}


	public static function getPostthirdparty()
	{
		$post                = [];
		$post['type']        = \dash\request::get('type');
		$post['mobile']      = \dash\request::post('mobile');
		$post['displayname'] = \dash\request::post('displayname');

		if(\dash\request::get('type') === 'supplier')
		{
			$post['companyname'] = \dash\request::post('companyname');
		}
		elseif(\dash\request::get('type') === 'staff')
		{
			$post['gender']      = \dash\request::post('gender');
			$post['firstname']   = \dash\request::post('name');
			$post['lastname']    = \dash\request::post('lastName');
			$post['displayname'] = trim($post['firstname']. ' '. $post['lastname']);
		}

		return $post;
	}
}
?>

<?php
namespace content_a\cart\user;

class model
{
	public static function post()
	{
		$post                = [];
		$post['customer']    = \dash\request::post('customer');
		$post['mobile']      = \dash\request::post('memberTl');
		$post['gender']      = \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null;
		$post['displayname'] = \dash\request::post('memberN');

		$user = \lib\app\cart\check::cart_user($post);
		if(isset($user['customer']))
		{
			$id = $user['customer'];
			$id = \dash\coding::encode($id);
			\dash\redirect::to(\dash\url::this(). '/add?user='. $id);
			return;
		}
		else
		{
			return false;
		}
	}
}
?>

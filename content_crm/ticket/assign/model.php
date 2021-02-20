<?php
namespace content_crm\ticket\assign;


class model
{
	public static function post()
	{
		$id            = \dash\request::get('id');
		$post                = [];
		$post['customer']    = \dash\request::post('customer');
		$post['mobile']      = \dash\request::post('memberTl');
		$post['gender']      = \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null;
		$post['displayname'] = \dash\request::post('memberN');

		$user = \dash\app\ticket\edit::assign_user($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='.\dash\request::get('id'));
		}
	}
}
?>

<?php
namespace content_enter\delete;


class model
{
	public static function post()
	{
		$condition = ['why' => 'string_200',];
		$args      = ['why' => \dash\request::post('why'),];
		$require   = [];
		$meta      = [];
		$data      = \dash\cleanse::input($args, $condition, $require, $meta);

		if($data['why'])
		{
			\dash\utility\enter::set_session('why', $data['why']);
		}
		// save log the user try to delete account
		\dash\log::set('enter:delete:try', ['from' => \dash\user::id(), 'why' => $data['why']]);
		// set session verify_from signup
		\dash\utility\enter::set_session('verify_from', 'delete');

		\dash\log::set('tryToDeleteAccount');

		\dash\utility\enter::set_session('usernameormobile', \dash\user::detail('mobile'));

		\dash\utility\enter::go_to_verify();
	}
}
?>
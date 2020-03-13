<?php
namespace content_enter\twostep;


class model
{
	public static function post()
	{
		if(!\dash\user::login())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'action' => ['enum' => ['active', 'deactive']],
		];

		$args =
		[
			'action' => \dash\request::post('action'),
		];

		$require = ['action'];

		$meta =
		[

		];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);


		if(\dash\user::detail('twostep') && $data['action'] === 'active')
		{
			\dash\notif::ok(T_("Two-step verification for you is already active"));
			return true;

		}

		if(!\dash\user::detail('twostep') && $data['action'] === 'deactive')
		{
			\dash\notif::warn(T_("Two-step verification for you is already deactive"));
			return true;
		}

		\dash\utility\enter::load_user_data(\dash\user::detail(), 'loaded');

		if($data['action'] === 'active')
		{
			\dash\utility\enter::set_session('verify_from', 'two_step_set');
		}
		else
		{
			\dash\utility\enter::set_session('verify_from', 'two_step_unset');
		}

		// send code way
		\dash\utility\enter::go_to_verify();


	}
}
?>
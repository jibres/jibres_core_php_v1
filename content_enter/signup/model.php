<?php
namespace content_enter\signup;


class model
{

	public static function post()
	{
		$condition =
		[
			'mobile'      => 'mobile',
			'password'    => 'password',
			'newpassword' => 'password',
			'displayname' => 'string_50',
		];

		$args =
		[
			'mobile'      => \dash\request::post('mobile'),
			'password'    => \dash\request::post('password'),
			'newpassword' => \dash\request::post('ramzNew'),
			'displayname' => \dash\request::post('displayname'),
		];

		$require = ['mobile', 'displayname', 'newpassword'];

		$meta =
		[
			'field_title' =>
			[
				'newpassword' => 'password',
			],
		];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);


		$count = \dash\session::get('count_signup_check');
		if($count)
		{
			\dash\session::set('count_signup_check', $count + 1, null, 60 * 10);
		}
		else
		{
			\dash\session::set('count_signup_check', 1, null, 60 * 10);
		}

		if($count >= 3)
		{
			\dash\log::set('userHitSignup3>30m');

			\dash\notif::warn(T_("You do not have permission to register for up to ten minutes"). ":)");
			return false;
		}

		if($data['password'])
		{
			\dash\log::set('hiddenPasswordFieldIsFull');
			\dash\notif::warn(T_("Your browser has sent a saved password. Delete it and continue"));
			$get          = \dash\request::get();
			$get['clean'] = '1';
			\dash\redirect::to(\dash\url::this(). '?'. http_build_query($get));
			return false;
		}

		// clean existing session
		\dash\utility\enter::clean_session();


		$mobile = $data['mobile'];
		if(!$mobile)
		{
			\dash\notif::error(T_("Pleaes set mobile number"), 'mobile');
			return false;
		}

		$ramz = $data['newpassword'];

		if($mobile && strpos($ramz, $mobile) !== false)
		{
			\dash\notif::error(T_("Please do not use your mobile in password!"), ['element' => ['newpassword', 'mobile']]);
			return false;
		}

		$displayname = $data['displayname'];

		$check_mobile = \dash\db\users::get_by_mobile($mobile);
		if($check_mobile)
		{
			\dash\log::set('mobileExistTryToSignup');
			$msg = T_("This mobile is already signuped. You can login by this mobile");
			$msg .= ' <br><a href="'. \dash\url::kingdom().'/enter">'. T_("Click to login"). '</a>';
			\dash\notif::error($msg, 'mobile');
			return false;
		}

		$signup =
		[
			'mobile'      => $mobile,
			'displayname' => $displayname,
			'status'      => 'awaiting'
		];

		\dash\utility\enter::set_session('verify_from', 'signup');

		\dash\utility\enter::set_session('temp_ramz_hash', \dash\utility::hasher($ramz));

		\dash\utility\enter::set_session('usernameormobile', $mobile);

		\dash\utility\enter::set_session('signup_detail', $signup);

		\dash\utility\enter::go_to_verify();

	}
}
?>
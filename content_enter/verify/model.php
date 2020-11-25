<?php
namespace content_enter\verify;


class model
{
	public static function post()
	{

		$way = \dash\utility\enter::list_send_code_way();
		if(!is_array($way))
		{
			$way = [];
		}

		$condition =
		[
			'usernameormobile' => 'mobile',
			'sendCode'         => ['enum' => $way],
		];

		if(\dash\temp::get('OnlyOneWay'))
		{
			$args = \dash\temp::get('OnlyOneWay');
		}
		else
		{
			$args =
			[
				'sendCode'         => \dash\request::post('sendCode'),
				'usernameormobile' => \dash\request::post('usernameormobile'),
			];
		}

		$require = ['sendCode', 'usernameormobile'];

		$meta =
		[
			'field_title' =>
			[
				'sendCode'         => 'Verify way',
				'usernameormobile' => 'mobile',
			],
		];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);


		$mobile    = $data['usernameormobile'];
		$send_code = $data['sendCode'];

		$exist_mobile = \dash\utility\enter::get_session('usernameormobile');

		if(!$exist_mobile && \dash\user::login())
		{
			if(\dash\user::detail('mobile'))
			{
				$exist_mobile = \dash\user::detail('mobile');
			}
			elseif(\dash\user::detail('username'))
			{
				$exist_mobile = \dash\user::detail('username');
			}
			elseif(\dash\user::detail('email'))
			{
				$exist_mobile = \dash\user::detail('email');
			}
		}

		if($mobile !== $exist_mobile)
		{
			if(\dash\validate::mobile($mobile) !== \dash\validate::mobile($exist_mobile))
			{
				\dash\log::set('existMobileIsNotMathcBySendMobile');

				\dash\notif::error(T_("What are you doing?"));
				return false;
			}
		}

		if($send_code !== 'later')
		{
			\dash\utility\enter::generate_verification_code();
		}

		if(\dash\url::isLocal() && $send_code !== 'later')
		{
			\dash\notif::ok(T_("Verify code in local is :code", ['code' => '<b>11111</b>']));
		}

		if($send_code !== 'later' && \dash\utility\enter::get_session('verify_from') === 'signup')
		{
			$signup = \dash\utility\enter::get_session('signup_detail');

			if(!$signup || !is_array($signup))
			{
				\dash\log::set('userDetailLostSignup');
				\dash\notif::error(T_("We can not find your detail to signup"));
				return false;
			}

			$user_id = \dash\app\user::quick_add($signup);

			if(!$user_id)
			{
				\dash\log::set('userCanNotSignupDB');
				\dash\notif::error(T_("We can not signup you"));
				return false;
			}

			// load user data by mobile
			$user_data = \dash\utility\enter::load_user_data($user_id, 'user_id');

			\dash\log::set('userSignup');

		}


		$select_way = 'verify/'. $send_code;
		\dash\utility\enter::open_lock($select_way);
		\dash\utility\enter::go_to($select_way);
	}
}
?>
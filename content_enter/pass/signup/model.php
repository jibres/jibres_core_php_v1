<?php
namespace content_enter\pass\signup;


class model
{
	public static function post()
	{
		$condition =
		[
			'ramzNew' => 'password',
		];

		$args =
		[
			'ramzNew' => \dash\request::post('ramzNew'),
		];

		$require = ['ramzNew'];

		$meta =
		[
			'field_title' =>
			[
				'ramzNew' => 'password',
			],
		];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		if($data['ramzNew'])
		{
			$temp_ramz = $data['ramzNew'];

			// check min and max of password and make error
			if(!\dash\utility\enter::check_pass_syntax($temp_ramz, \dash\utility\enter::user_data('mobile')))
			{
				return false;
			}

			// hesh ramz to find is this ramz is easy or no
			// creazy password !
			$temp_ramz_hash = \dash\utility::hasher($temp_ramz);
			// if debug status continue
			if(\dash\engine\process::status())
			{
				\dash\utility\enter::set_session('temp_ramz', $temp_ramz);
				\dash\utility\enter::set_session('temp_ramz_hash', $temp_ramz_hash);
			}
			else
			{
				\dash\log::set('creazyPassword');

				// creazy password
				return false;
			}
		}
		else
		{
			\dash\utility\enter::try('pass_signup_password_not_set');
			\dash\notif::error(T_("No password was send"));
			return false;
		}

		\dash\log::set('setSignupPasswordRequest');

		// set session verify_from signup
		\dash\utility\enter::set_session('verify_from', 'signup');

		// send code way
		\dash\utility\enter::go_to_verify();
	}
}
?>
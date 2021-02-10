<?php
namespace content_enter\pass\change;


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
			'passwd_mobile' => \dash\user::detail('mobile'),
			'displayname'   => \dash\user::detail('displayname'),
		];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);


		if($data['ramzNew'])
		{
			$temp_ramz = $data['ramzNew'];

			// check new password = old password
			// needless to change password
			if(\dash\user::detail('password'))
			{
				if(\dash\utility::hasher($temp_ramz, \dash\user::detail('password')))
				{
					// old pass = new pass
					// aletr to user the new pass = old pass
					// login
					\dash\log::set('oldPassword=newPasswordInChange');

					$url             = \dash\url::sitelang(). '/account/security';
					$alert           = [];
					$alert['text']   = T_("Your new password is your old password");
					$alert['link']   = $url;
					$alert['button'] = T_("Ok");

					\dash\utility\enter::set_session('alert', $alert);
					// open lock alert page
					\dash\utility\enter::next_step('alert');
					// go to alert page
					\dash\utility\enter::go_to('alert');
					// done ;)
					return;
				}
			}

			// check min and max of password
			// if not okay make debug error and return false
			if(!\dash\utility\enter::check_pass_syntax($temp_ramz, \dash\user::detail('mobile')))
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
			\dash\utility\enter::try('pass_recovery_pass_not_set');
			\dash\notif::error(T_("Invalid Password"));
			return false;
		}

		\dash\log::set('passwordChaneRequest');

		// set session verify_from password_change
		\dash\utility\enter::set_session('verify_from', 'password_change');

		// send code way
		\dash\utility\enter::go_to_verify();
	}
}
?>
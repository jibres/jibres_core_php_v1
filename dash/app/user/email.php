<?php
namespace dash\app\user;


class email
{
	public static function get_my_list()
	{
		if(!\dash\user::id())
		{
			return [];
		}

		$result = \dash\db\useremail::get_by_user_id(\dash\user::id());

		if(!is_array($result))
		{
			$result = [];
		}

		return $result;
	}

	public static function remove($_email)
	{
		$email = \dash\validate::email($_email);
		if(!$email)
		{
			\dash\notif::error(T_("Please enter email"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\user::id();

		$check_duplicate_email = \dash\db\useremail::check_duplicate_email($email, $user_id);

		if(isset($check_duplicate_email['id']))
		{
			 // nothing
		}
		else
		{
			\dash\notif::error(T_("Email not found"));
			return false;
		}

		$remove = \dash\db\useremail::remove($email, $user_id);

		if(isset($check_duplicate_email['primary']) && $check_duplicate_email['primary'])
		{
			\dash\db\users::update(['email' => null], $user_id);
		}

		if($remove)
		{
			\dash\notif::ok(T_("Your email was removed"));
			return true;
		}
		else
		{
			\dash\log::oops('emailErrorDB');
			return false;
		}




	}

	public static function verify($_email)
	{
		$email = \dash\validate::email($_email);
		if(!$email)
		{
			\dash\notif::error(T_("Please enter email"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\user::id();

		$check_duplicate_email = \dash\db\useremail::check_duplicate_email($email, $user_id);

		if(isset($check_duplicate_email['id']))
		{
			 // nothing
		}
		else
		{
			\dash\notif::error(T_("Email not found"));
			return false;
		}

		if(isset($check_duplicate_email['verify']) && $check_duplicate_email['verify'])
		{
			\dash\notif::info(T_("This email is already verified"));
			return true;
			// ok. the email is verified
		}


		$check_any_verify_it = \dash\db\useremail::check_is_verify_for_other($email);
		if(isset($check_any_verify_it['user_id']))
		{
			if(floatval($check_any_verify_it['user_id']) === floatval($user_id))
			{
				\dash\notif::error(T_("You already verified this email"));
			}
			else
			{
				\dash\notif::error(T_("This email is already verified for another user"));
			}

			return false;
		}

		$code1 = '';
		$code1 .= time();
		$code1 .= '()';
		$code1 .= $user_id;
		$code1 .= rand();
		$code1 .= '%%';
		$code1 .= microtime();
		$code1 = md5($code1);

		$code2 = '';
		$code2 .= $user_id;
		$code2 .= '&^';
		$code2 .= time();
		$code2 .= rand();
		$code2 .= '**';
		$code2 .= rand();
		$code2 .= '_-';
		$code2 .= \dash\url::pwd();
		$code2 = md5($code2);

		$code = $code1.$code2;


		$log =
		[
			'to'   => $user_id,
			'code' => $code,
			'email' => json_encode(
			[
				'useremail_id' => $check_duplicate_email['id'],
				'email'        => $email,
			], JSON_UNESCAPED_UNICODE),
		];

		\dash\log::set('verifyEmail', $log);

		$url = \dash\url::kingdom(). '/enter/verifyemail/'. $code;
		$body = '';
		$body .= '<p>';
		$body .= T_("To confirm your email in Jibres"). ' ';
		$body .= '<a href="'.$url.'" target="_blank">'. T_("Click here"). '</a>';
		$body .= '</p>';

		$email =
		[
			'to'       => $email,
			'body'     => $body,
			'template' => 'html',
			'subject'  => T_("Verify your mail"),
		];

		$send = \lib\email\send::send($email);

		\dash\notif::ok(T_("A verification email was send to your email"));
		return true;

	}

	public static function primary($_email)
	{
		$email = \dash\validate::email($_email);
		if(!$email)
		{
			\dash\notif::error(T_("Please enter email"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\user::id();

		$check_duplicate_email = \dash\db\useremail::check_duplicate_email($email, $user_id);

		if(isset($check_duplicate_email['id']))
		{
			 // nothing
		}
		else
		{
			\dash\notif::error(T_("Email not found"));
			return false;
		}

		if(isset($check_duplicate_email['primary']) && $check_duplicate_email['primary'])
		{
			\dash\notif::info(T_("This email is already set as primary email"));
			return true;
		}

		if(isset($check_duplicate_email['verify']) && $check_duplicate_email['verify'])
		{
			// ok. the email is verified
		}
		else
		{
			\dash\notif::error(T_("Please verify the email to set as primary"));
			return true;
		}


		\dash\db\useremail::remove_all_other_primary($user_id);
		\dash\db\useremail::set_primary_id($check_duplicate_email['id']);


		$primary = \dash\db\users::update(['email' => $email], $user_id);
		if($primary)
		{
			\dash\notif::ok(T_("Your email was set as primary"));
			return true;
		}
		else
		{
			\dash\log::oops('emailErrorDB');
			return false;
		}
	}


	public static function add($_email)
	{
		$email = \dash\validate::email($_email);
		if(!$email)
		{
			\dash\notif::error(T_("Please enter email"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\user::id();

		$check_is_verify_for_other = \dash\db\useremail::check_is_verify_for_other($email);

		if(isset($check_is_verify_for_other['user_id']))
		{
			if(floatval($check_is_verify_for_other['user_id']) === floatval(\dash\user::id()))
			{
				\dash\notif::error(T_("This email already added to your panel"));
			}
			else
			{
				\dash\notif::error(T_("This email is already taken"));
			}

			return false;
		}

		$check_duplicate_email = \dash\db\useremail::check_duplicate_email($email, $user_id);

		if(isset($check_duplicate_email['id']))
		{
			\dash\notif::error(T_("This email is already exist in your list"));
			return false;
		}

		$count_email = \dash\db\useremail::get_count_by_user_id($user_id);

		if(floatval($count_email) >= 20)
		{
			\dash\notif::error(T_("Maximum email capacity is 20 per user"));
			return false;
		}


		$insert_args =
		[
			'user_id'     => $user_id,
			'email'       => $email,
			'status'      => 'enable',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$insert = \dash\db\useremail::insert($insert_args);
		if($insert)
		{
			\dash\notif::ok(T_("Your email was added"));
			return true;
		}
		else
		{
			\dash\log::oops('emailErrorDB');
			return false;
		}



	}
}
?>

<?php
namespace dash\app\user;


class email
{
	public static function get_user_email_count($_user_id = null)
	{
		if($_user_id)
		{
			$user_id = $_user_id;
		}
		else
		{
			$user_id = \dash\user::id();
		}

		if(!$user_id)
		{
			return [];
		}

		$result = \dash\db\useremail::get_count_by_user_id($user_id);

		return floatval($result);
	}



	public static function get_user_email_primary($_user_id = null)
	{
		if($_user_id)
		{
			$user_id = $_user_id;
		}
		else
		{
			$user_id = \dash\user::id();
		}

		if(!$user_id)
		{
			return [];
		}

		$result = \dash\db\useremail::get_user_email_primary($user_id);

		return $result;
	}

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

	public static function remove($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\user::id();

		$check_is_my_email = \dash\db\useremail::check_is_my_email_id($id, $user_id);

		if(isset($check_is_my_email['id']))
		{
			 // nothing
		}
		else
		{
			\dash\notif::error(T_("Email not found"));
			return false;
		}

		$remove = \dash\db\useremail::remove($id, $user_id);

		if(isset($check_is_my_email['primary']) && $check_is_my_email['primary'])
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

	public static function verify($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}


		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\user::id();

		$check_is_my_email = \dash\db\useremail::check_is_my_email_id($id, $user_id);

		if(isset($check_is_my_email['id']))
		{
			 // nothing
		}
		else
		{
			\dash\notif::error(T_("Email not found"));
			return false;
		}

		if(isset($check_is_my_email['verify']) && $check_is_my_email['verify'])
		{
			\dash\notif::info(T_("This email is already verified"));
			return true;
			// ok. the email is verified
		}



		$email = $check_is_my_email['email'];

		$emailraw   = \dash\validate::email_raw($check_is_my_email['email']);

		$check_any_verify_it = \dash\db\useremail::check_is_verify_for_other($emailraw);

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

		if(isset($check_is_my_email['daterequestverify']) && $check_is_my_email['daterequestverify'])
		{
			if(time() - strtotime($check_is_my_email['daterequestverify']) < (60*10))
			{
				\dash\notif::error(T_("Can not send verification email at now!"));
				return false;
			}
		}

		\dash\db\useremail::update(['daterequestverify' => date("Y-m-d H:i:s")], $check_is_my_email['id']);

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
				'useremail_id' => $check_is_my_email['id'],
				'email'        => $email,
				'emailraw'     => \dash\validate::email_raw($email),
			], JSON_UNESCAPED_UNICODE),
		];

		\dash\log::set('verifyEmail', $log);

		$url = \dash\url::kingdom(). '/enter/verifyemail/'. $code;
		// $body = '';
		// $body .= '<p>';
		// $body .= T_("To confirm your email in Jibres"). ' ';
		// $body .= '<a href="'.$url.'" target="_blank" clicktracking=off >'. T_("Click here"). '</a>';
		// $body .= '</p>';

		// $email =
		// [
		// 	'to'       => $email,
		// 	'body'     => $body,
		// 	'template' => 'html',
		// 	'subject'  => T_("Verify your mail"),
		// ];

		// $send = \lib\email\send::send($email);

		$args = \dash\email\template::verify(true, $email, \dash\user::detail('displayname'), $url);

		\dash\notif::ok(T_("A verification email was send to your email"));
		return true;

	}

	public static function primary($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_id = \dash\user::id();

		$check_is_my_email = \dash\db\useremail::check_is_my_email_id($id, $user_id);

		if(isset($check_is_my_email['id']))
		{
			 // nothing
		}
		else
		{
			\dash\notif::error(T_("Email not found"));
			return false;
		}

		$email = $check_is_my_email['email'];

		if(isset($check_is_my_email['primary']) && $check_is_my_email['primary'])
		{
			\dash\notif::info(T_("This email is already set as primary email"));
			return true;
		}

		if(isset($check_is_my_email['verify']) && $check_is_my_email['verify'])
		{
			// ok. the email is verified
		}
		else
		{
			\dash\notif::error(T_("Please verify the email to set as primary"));
			return true;
		}


		\dash\db\useremail::remove_all_other_primary($user_id);
		\dash\db\useremail::set_primary_id($check_is_my_email['id']);


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

		$emailraw   = \dash\validate::email_raw($email);

		$check_is_verify_for_other = \dash\db\useremail::check_is_verify_for_other($emailraw);

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


		$count_email = \dash\db\useremail::get_count_by_user_id($user_id);

		if(floatval($count_email) >= 10)
		{
			\dash\notif::error(T_("Maximum email capacity is 10 per user"));
			return false;
		}

		$check_is_my_email = \dash\db\useremail::check_is_my_email_raw($emailraw, $user_id);

		if(isset($check_is_my_email['id']))
		{
			if(isset($check_is_my_email['status']) && $check_is_my_email['status'] === 'delete')
			{
				\dash\db\useremail::update(['status' => 'enable', 'email' => $email], $check_is_my_email['id']);
				$new_id = $check_is_my_email['id'];
			}
			else
			{
				\dash\notif::error(T_("This email is already exist in your list"));
				return false;
			}
		}
		else
		{
			$insert_args =
			[
				'user_id'     => $user_id,
				'email'       => $email,
				'emailraw'    => $emailraw,
				'status'      => 'enable',
				'datecreated' => date("Y-m-d H:i:s"),
			];

			$insert = \dash\db\useremail::insert($insert_args);
			$new_id = $insert;

		}

		self::verify($new_id);

		\dash\notif::clean();

		\dash\notif::ok(T_("Your email was added"));
		return true;



	}
}
?>

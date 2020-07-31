<?php
namespace content_enter\verifyemail;


class controller
{
	public static function routing()
	{
		if(\dash\url::subchild())
		{
			\dash\header::status(404);
		}

		$code = \dash\url::child();

		$code = \dash\validate::string_64_64($code);


		$find_log =
		[
			'caller' => 'verifyEmail',
			'code'   => $code,
			// 'status' => 'enable',
		];

		$find_log = \dash\db\logs::get($find_log);

		if(!$find_log || !is_array($find_log))
		{
			\dash\header::status(403, T_("Invalid verification code"));

		}

		if(count($find_log) > 1)
		{
			\dash\log::set('enter:callback:email:more:than:one:log:found', $log_detail);
			foreach ($find_log as $key => $value)
			{
				if(isset($value['id']))
				{
					\dash\db\logs::update(['status' => 'expire'], $value['id']);
				}
			}

			\dash\data::verifyMesssage(T_("Please verify again your email"));


		}


		if(count($find_log) === 1)
		{
			$find_log = $find_log[0];

			if(isset($find_log['status']))
			{
				if($find_log['status'] === 'enable')
				{
					if(isset($find_log['email']) && isset($find_log['id']))
					{
						\dash\db\logs::update(['status' => 'deliver'], $find_log['id']);
						$email_detail = $find_log['email'];
						$email_detail = json_decode($email_detail, true);

						if(isset($email_detail['email']) && isset($email_detail['useremail_id']))
						{
							$check_is_verified = \dash\db\useremail::check_is_verify_for_other($email_detail['email']);
							if($check_is_verified)
							{
								\dash\data::verifyMesssage(T_("This email is verified before"));
							}
							else
							{
								\dash\db\useremail::set_verify($email_detail['useremail_id'], $email_detail['email']);
								\dash\data::verifyMesssage(T_("Email was verified"));
							}
						}
						else
						{
							\dash\header::status(404);
						}
					}
					else
					{
						\dash\header::status(404);
					}
				}
				elseif($find_log['status'] === 'expire')
				{
					\dash\data::verifyMesssage(T_("This verification email is expired"));
				}
				elseif($find_log['status'] === 'deliver')
				{
					\dash\data::verifyMesssage(T_("This email is already verified"));
				}
				else
				{
					\dash\data::verifyMesssage(T_("Invalid verification code"));
				}
			}
			else
			{
				\dash\header::status(404);
			}


		}
		\dash\open::get();



	}
}
?>
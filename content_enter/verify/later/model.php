<?php
namespace content_enter\verify\later;


class model
{

	/**
	* check sended code
	*/
	public static function post()
	{
		if(\dash\request::post('force_signup') === 'true' && \dash\utility\enter::get_session('verify_from') === 'signup')
		{
			$signup = \dash\utility\enter::get_session('signup_detail');

			if(!$signup || !is_array($signup))
			{
				\dash\log::set('userDetailLostSignup');
				\dash\notif::error(T_("We can not find your detail to signup"));
				return false;
			}

			if(\dash\utility\enter::get_session('temp_ramz_hash'))
			{
				$signup['password'] = \dash\utility\enter::get_session('temp_ramz_hash');
			}

			$signup['verifymobile'] = 0;

			$myIp = \dash\server::ip();
			$count_signup_not_verify = \dash\db\login\get::get_count_all_on_ip($myIp);

			if(floatval($count_signup_not_verify) >= 10)
			{
				\dash\notif::error(T_("You must verify mobile to continue"));
				return false;
			}

			$user_id = \dash\app\user::quick_add($signup);

			if(!$user_id)
			{
				\dash\log::set('userCanNotSignupDB');
				\dash\notif::error(T_("We can not signup you"));
				return false;
			}

			\dash\log::set('userSignup');

			\dash\utility\enter::load_user_data($user_id, 'user_id');
			\dash\utility\enter::enter_set_login(null, true);
		}
		else
		{
			\dash\notif::error(T_("Invalid detail for signup!, Please try again"));
			return false;
		}
	}
}
?>

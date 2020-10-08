<?php
namespace content_enter;


class view
{

	public static function config()
	{
		// get mobile number to show in mobile input
		$session_mobile = \dash\utility\enter::get_session('usernameormobile');
		$temp_mobile    = \dash\utility\enter::get_session('temp_mobile');
		$myMobile       = null;
		$get_mobile     = \dash\validate::mobile(\dash\request::get('mobile'));

		$main_account = false;
		// if(isset($_SESSION['main_account']) && $_SESSION['main_account'])
		// {
		// 	$main_account = true;
		// }


		if(\dash\user::login('mobile'))
		{
			$myMobile = \dash\user::login('mobile');
		}
		elseif($session_mobile)
		{
			$myMobile = $session_mobile;
		}
		elseif($temp_mobile)
		{
			$myMobile = $temp_mobile;
		}
		elseif($get_mobile && !$main_account)
		{
			$myMobile = $get_mobile;
		}

		if($get_mobile  && \dash\permission::check('EnterByAnother'))
		{
			$myMobile = $get_mobile;
		}

		$userid = \dash\validate::id_code(\dash\request::get('userid'));
		if($userid && \dash\permission::check('EnterByAnother'))
		{
			$myMobile   = $userid;
			$get_mobile = true;
		}


		// if mobile not set but the user was login
		// for example in pass/change page
		// get the user mobile from login.mobile
		// set mobile in display
		\dash\data::getMobile($myMobile);
		\dash\data::getUsernamemobile($myMobile);

		if(!\dash\url::module())
		{
			if(\dash\permission::check('EnterByAnother'))
			{
				if(!$get_mobile)
				{
					\dash\data::getMobile(null);
					\dash\data::getUsernamemobile(null);
				}
			}
		}


		// in all page the mobiel input is readonly
		\dash\data::mobileReadonly(true);

		\dash\data::googleLogin(false);

		if(\dash\url::subdomain())
		{
			\dash\data::googleLogin(false);
		}

	}
}
?>
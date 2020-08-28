<?php
namespace content_enter\verify;


class view
{

	public static function config()
	{
		$mobile_or_email = \dash\data::getUsernamemobile();

		\dash\data::sendWayCod(\dash\utility\enter::list_send_code_way());

		// load temp username in username field
		if(\dash\utility\enter::get_session('username', 'temp_username'))
		{
			\dash\data::getUsername(\dash\utility\enter::get_session('username', 'temp_username'));
		}

		self::verifyPageTitle();

		// back
		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('Back'));
		// action
		// \dash\data::action_text(T_('Recovery'));
		// \dash\data::action_link(\dash\url::here(). '/pass/recovery');

	}

	public static function verifyPageTitle()
	{

		\dash\data::rememberLink(false);
		\dash\data::startNewMobile(false);
		// the verify msg
		$myDesc = T_('Please verify yourself.'). ' ';
		$verifyReason = '';

		switch (\dash\url::child())
		{
			case 'telegram':
				$myDesc .= T_("We've sent the code via Telegram. Please enter the code below.");
				break;

			case 'call':
				$myDesc .= T_("We trying to call you. be patient...");
				break;

			case 'sms':
				$myDesc .= T_("Your verification code sended to your mobile number via sms. be patient...");
				break;

			case 'sendsms':
				$myDesc .= T_("We can't send code to you with our existing methods! For the last chance of verify yourself you can send code to our number.");
				break;

			case 'later':
				$myDesc = T_("You requested to verify your account later.");
				break;

			case null:
				$myDesc .= null;
				break;

			default:
				$myDesc .= T_("What happend?");
				break;
		}

		// back
		\dash\data::back_link(\dash\url::here(). '/verify');
		\dash\data::back_text(T_('Back'));
		// action
		// \dash\data::action_text(T_('Recovery'));
		// \dash\data::action_link(\dash\url::here(). '/pass/recovery');


		// swich verify from
		switch (\dash\utility\enter::get_session('verify_from'))
		{
			case 'ask_twostep':
				\dash\data::rememberLink(false);
				\dash\data::startNewMobile(true);
				$verifyReason = T_("This is request of two-step verification!");
				break;

			case 'two_step_set':
				\dash\data::rememberLink(false);
				\dash\data::startNewMobile(false);
				$verifyReason = T_("This is request of active two-step verification of you account!");
				break;

			case 'two_step_unset':
				\dash\data::rememberLink(false);
				\dash\data::startNewMobile(false);
				$verifyReason = T_("This is request of deactive two-step verification of you account!");
				break;

			// user from signup go to this page
			case 'signup':
			case 'set':
				\dash\data::rememberLink(false);
				\dash\data::startNewMobile(false);
				// $verifyReason = T_("Your verification code send to your telegram.");
				break;

			// user from delete go to this page
			case 'delete':
				\dash\data::rememberLink(false);
				\dash\data::startNewMobile(false);
				$verifyReason = T_("This is request of delete account!");
				break;

			// user from recovery go to this page
			case 'recovery':
				\dash\data::rememberLink(true);
				\dash\data::startNewMobile(true);
				$verifyReason = T_("This is request of account recovery.");
				break;

			// user from change password go to this page
			case 'password_change':
				\dash\data::rememberLink(false);
				\dash\data::startNewMobile(false);
				// swich way
				$verifyReason = T_("This is request of change password.");
				break;
		}

		$myDesc                 = trim($myDesc);
		$myTitle                = T_('Verify');
		// set title of pages
		switch (\dash\url::dir(1))
		{
			case 'call':
				$myTitle = T_('Verify by Call');
				break;

			case 'telegram':
				$myTitle = T_('Verify via Telegram');
				break;

			case 'sms':
				$myTitle = T_('verify with SMS');
				break;

			case 'later':
				$myTitle = T_('Really want to verify later?');
				break;
		}

		\dash\face::title($myTitle);
		\dash\face::desc($myDesc);
		\dash\face::reason($verifyReason);
	}
}
?>
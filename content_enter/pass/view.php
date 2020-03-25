<?php
namespace content_enter\pass;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Password'));
		\dash\data::page_desc(T_('Please enter password to enter'));

		switch (\dash\url::child())
		{
			case 'recovery':
				\dash\face::title(T_('Recovery Password'));
				\dash\data::page_desc(T_('If forget your password, Please enter new password. after pass verification your new password is usable.'));
				break;

			case 'signup':
			case 'set':
				\dash\face::title(T_('Set Password'));
				\dash\data::page_desc(T_('Please set your password to secure signup.'). ' '. T_('Next time we only need your mobile and this password to enter'));
				break;

			case 'change':
				\dash\face::title(T_('Change to new Password'));
				\dash\data::page_desc(T_('Please set new password to change it'));
				break;

			default:
				break;
		}

		// back
		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('Back'));
		// action
		// \dash\data::action_text(T_('Recovery'));
		// \dash\data::action_link(\dash\url::here(). '/pass/recovery');
	}
}
?>
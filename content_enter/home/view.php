<?php
namespace content_enter\home;


class view
{

	public static function config()
	{

		\dash\face::title(T_('Enter to :name', ['name' => \dash\face::hereTitle()]));
		\dash\face::specialTitle(true);
		\dash\face::desc(T_("Welcome back. Bring your idea to life with Jibres."));

		if(mb_strlen(\dash\face::desc()) < 150)
		{
			\dash\face::desc(\dash\face::desc(). ' | '. \dash\face::hereTitle());
			if(mb_strlen(\dash\face::desc()) < 150)
			{
				if(\dash\face::hereTitle() !== T_('Jibres'))
				{
					\dash\face::desc(\dash\face::desc(). ' | '. T_('Jibres'));
				}
			}
		}

		$hideBtnSignup = \content_enter\controller::check_disallow_business_enter_signup();
		\dash\data::hideBtnSignup($hideBtnSignup);


		\dash\data::mobileReadonly(false);

		// back
		\dash\data::back_link(\dash\url::kingdom());
		\dash\data::back_text(T_('Home'));
		// action
		\dash\data::action_text(T_('Signup'));
		\dash\data::action_link(\dash\url::here(). '/signup');


		$mobile = \dash\validate::mobile(\dash\request::get('mobile'));

		if(\dash\request::get('autosend') && $mobile)
		{
			\content_enter\home\model::enter_post($mobile);
		}
	}
}
?>
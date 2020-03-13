<?php
namespace content_enter\home;


class view
{

	public static function config()
	{
		\dash\data::page_special(true);
		\dash\data::page_title(T_('Enter to :name', ['name' => \dash\data::site_title()]));
		\dash\data::page_desc(\dash\data::site_desc());

		if(mb_strlen(\dash\data::page_desc()) < 150)
		{
			\dash\data::page_desc(\dash\data::page_desc(). ' | '. \dash\data::site_title());
			if(mb_strlen(\dash\data::page_desc()) < 150)
			{
				\dash\data::page_desc(\dash\data::page_desc(). ' | '. T_('Jibres'));
			}
		}
		\dash\data::mobileReadonly(false);

		// back
		\dash\data::back_link(\dash\url::kingdom());
		\dash\data::back_text(T_('Home'));
		// action
		\dash\data::action_text(T_('Signup'));
		\dash\data::action_link(\dash\url::here(). '/signup');

		$main_account = false;
		if(isset($_SESSION['main_account']) && $_SESSION['main_account'])
		{
			$main_account = true;
		}

		$mobile = \dash\validate::mobile(\dash\request::get('mobile'));

		if($mobile && !$main_account)
		{
			\dash\data::getMobile($mobile);
		}

		if(\dash\request::get('autosend') && \dash\request::get('mobile'))
		{
			$mobile = \dash\utility\filter::mobile(\dash\request::get('mobile'));
			if($mobile)
			{
				\content_enter\home\model::enter_post($mobile);
			}
		}
	}
}
?>
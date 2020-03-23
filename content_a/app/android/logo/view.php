<?php
namespace content_a\app\android\logo;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Application logo'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\content_a\app\android\view::ready();

		if(!\dash\data::appDetail_logo())
		{
			if(\lib\app\application\detail::can_user_store_logo())
			{
				\dash\data::canUseStoreLogo(true);
			}
		}
	}
}
?>

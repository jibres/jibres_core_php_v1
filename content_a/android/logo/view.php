<?php
namespace content_a\android\logo;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Application logo'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\content_a\android\load::detail();

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

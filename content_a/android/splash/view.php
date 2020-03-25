<?php
namespace content_a\android\splash;


class view
{
	public static function config()
	{
		\dash\face::title(T_('App splash'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		\content_a\android\load::detail();

		\dash\data::loadScript(true);

		$theme_color = \lib\app\application\splash::theme_color();
		\dash\data::themeColor($theme_color);


	}
}
?>

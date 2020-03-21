<?php
namespace content_a\app\android\splash;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Splash setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$saved = \lib\app\application\splash::get_android();

		\dash\data::splashSaved($saved);
		\content_a\app\android\view::ready();

		\dash\data::loadScript(true);

	}
}
?>

<?php
namespace content_a\app\android\splash;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Intro setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$saved = \lib\app\application\splash::get_android();

		\dash\data::splashSaved($saved);

	}
}
?>

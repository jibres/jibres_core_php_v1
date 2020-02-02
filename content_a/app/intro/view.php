<?php
namespace content_a\app\intro;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Intro setting'));

		// back
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());

		$saved = \lib\app\application\theme::get();

		\dash\data::themeSaved($saved);

	}
}
?>

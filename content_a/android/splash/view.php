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

		\dash\data::global_scriptPage('a_androidsplash.js');

		$theme_color = \lib\app\application\splash::theme_color();
		\dash\data::themeColor($theme_color);

		$splashSaved = \dash\data::splashSaved();


		if(!$splashSaved)
		{
			$splashSaved =
			[
				'start'      => '#5583EE',
				'end'        => '#41D8DD',
				'text_color' => '#ffffff',
				'meta_color' => '#eeeeee',
				'key'        => '#5583EE_#41D8DD_#ffffff_#eeeeee',
			];

			\dash\data::splashSaved($splashSaved);
		}


	}
}
?>

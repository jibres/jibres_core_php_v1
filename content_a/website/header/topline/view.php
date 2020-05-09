<?php
namespace content_a\website\header\topline;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Set header top line'));

		// back
		\dash\data::back_text(T_('Header'));
		\dash\data::back_link(\dash\url::that(). '/customize');

		\dash\data::toplineSaved(\lib\app\website\header\topline::get());
	}
}
?>

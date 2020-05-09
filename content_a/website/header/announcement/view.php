<?php
namespace content_a\website\header\announcement;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Set header Special Announcement'));

		// back
		\dash\data::back_text(T_('Header'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::toplineSaved(\lib\app\website\header\topline::get());
	}
}
?>

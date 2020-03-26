<?php
namespace content_a\website\header\customize;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Website Headers'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$header_template = \lib\app\website_header\template::list();

		\dash\data::headerTemplate($header_template);
	}
}
?>

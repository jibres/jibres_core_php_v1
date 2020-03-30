<?php
namespace content_a\website\header;


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


		$isset_header = \lib\app\website_header\get::isset_header(true);
		\dash\data::issetHeader($isset_header);


	}
}
?>

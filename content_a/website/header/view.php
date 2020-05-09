<?php
namespace content_a\website\header;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Choose Header Template'));

		// back
		\dash\data::back_text(T_('Header'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'tag' => \dash\request::get('tag'),
		];

		$header_template = \lib\app\website\header\template::list($args);

		\dash\data::headerTemplate($header_template);


		$isset_header = \lib\app\website\header\get::isset_header(true);
		\dash\data::issetHeader($isset_header);


	}
}
?>

<?php
namespace content_a\website\footer\template;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Choose Footer Template'));

		// back
		\dash\data::back_text(T_('Footer'));
		\dash\data::back_link(\dash\url::that());

		$args =
		[
			'tag' => \dash\request::get('tag'),
		];

		$footer_template = \lib\app\website\footer\template::list($args);

		\dash\data::footerTemplate($footer_template);


		$isset_footer = \lib\app\website\footer\get::isset_footer(true);
		\dash\data::issetFooter($isset_footer);


	}
}
?>

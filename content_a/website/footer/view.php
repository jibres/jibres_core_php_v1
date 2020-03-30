<?php
namespace content_a\website\footer;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Website Footers'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$footer_template = \lib\app\website_footer\template::list();

		\dash\data::footerTemplate($footer_template);


		$isset_footer = \lib\app\website_footer\get::isset_footer(true);
		\dash\data::issetFooter($isset_footer);


	}
}
?>

<?php
namespace content_a\pagebuilder\seo;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Customize SEO'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/manage'. \dash\request::full_get());

		\dash\face::btnSave('editFormSEO');

		$load_line = \lib\pagebuilder\tools\get::current_line_list();
		\dash\data::lineList($load_line);

	}
}
?>
<?php
namespace content_a\pagebuilder\seo;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Customize SEO'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/build'. \dash\request::full_get());

		\dash\face::btnSave('editFormSEO');

		$get       = \dash\request::get();
		$load_line = \lib\pagebuilder\tools\search::list($get);
		\dash\data::lineList($load_line);

	}
}
?>
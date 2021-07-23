<?php
namespace content_site\page\settings;


class view extends \content_site\page\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Page setting'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). \dash\request::full_get());
	}
}
?>
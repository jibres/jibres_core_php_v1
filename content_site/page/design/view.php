<?php
namespace content_site\page\design;


class view extends \content_site\page\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Page design'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). \dash\request::full_get());
	}
}
?>
<?php
namespace content_site\page\duplicate;


class view extends \content_site\page\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Duplicate page'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). \dash\request::full_get());



		// show display inside sidebar and iframe in page center
		\dash\data::include_adminPanelBuilder(true);

	}
}
?>
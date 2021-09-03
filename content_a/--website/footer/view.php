<?php
namespace content_a\website\footer;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Customize Your Website Footer'));

		// back
		\dash\data::back_text(T_('Website Builder'));
		\dash\data::back_link(\dash\url::this());
		// preview
		\dash\face::btnPreview(\lib\store::url());

		if(true) // check need to load menu
		{
			$menu = \lib\app\menu\get::list_all_menu();
			\dash\data::allMenu($menu);
		}

	}
}
?>

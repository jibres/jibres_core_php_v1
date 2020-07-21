<?php
namespace content_a\website\header;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Customize Your Website Header'));

		// back
		\dash\data::back_text(T_('Website Builder'));
		\dash\data::back_link(\dash\url::this());
		// preview
		\dash\face::btnPreview(\lib\store::url());

		if(true) // check need to load menu
		{
			$menu = \lib\app\website\menu\get::list_all_menu();
			\dash\data::allMenu($menu);
		}

		\dash\data::toplineSaved(\lib\app\website\header\topline::get());


		\dash\data::maxUploadSize(\dash\upload\size::cms_file_size(true));
	}
}
?>

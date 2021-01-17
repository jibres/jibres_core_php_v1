<?php
namespace content_cms\posts\publishdate;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit post publish date"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/setting'. \dash\request::full_get());


		$cmsSettingSaved = \lib\app\setting\get::cms_setting();
		if(isset($cmsSettingSaved['defaultshowdate']))
		{
			if($cmsSettingSaved['defaultshowdate'] === 'visible')
			{
				$defaultTitle = T_("Default (Visible)");
			}
			else
			{
				$defaultTitle = T_("Default (Hidden)");

			}
		}
		else
		{
			$defaultTitle = T_("Default");
		}

		\dash\data::defaultTitleShowdate($defaultTitle);

	}
}
?>
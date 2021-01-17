<?php
namespace content_cms\posts\setting;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Edit post setting"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/edit'. \dash\request::full_get());

		$cmsSettingSaved = \lib\app\setting\get::cms_setting();
		if(isset($cmsSettingSaved['defaultcomment']))
		{
			if($cmsSettingSaved['defaultcomment'] === 'open')
			{
				$defaultTitle = T_("Default (Open)");
			}
			else
			{
				$defaultTitle = T_("Default (Closed)");

			}
		}
		else
		{
			$defaultTitle = T_("Default");
		}

		\dash\data::defaultTitleComment($defaultTitle);


	}
}
?>
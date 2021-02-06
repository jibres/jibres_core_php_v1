<?php
namespace content_cms\posts\advance;

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

		if(\dash\data::dataRow_user_id())
		{
			\dash\data::postWriterOld(\dash\app\user::get(\dash\data::dataRow_user_id()));
		}

	}
}
?>
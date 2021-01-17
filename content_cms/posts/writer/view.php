<?php
namespace content_cms\posts\writer;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit post writer"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/edit'. \dash\request::full_get());


		$postWriter = \dash\app\posts\get::post_writer_list();
		\dash\data::postWriter($postWriter);

		if(is_array($postWriter) && !in_array(\dash\data::dataRow_user_id(), array_column($postWriter, 'id')))
		{
			\dash\data::postWriterOld(\dash\app\user::get(\dash\data::dataRow_user_id()));
		}

		$cmsSettingSaved = \lib\app\setting\get::cms_setting();

		if(isset($cmsSettingSaved['defaultshowwriter']))
		{
			if($cmsSettingSaved['defaultshowwriter'] === 'visible')
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

		\dash\data::defaultTitleShowwriter($defaultTitle);

	}
}
?>
<?php
namespace content_cms\posts\edit;

class view
{
	public static function config()
	{

		$moduleTypeTxt = \dash\data::myType();
		$moduleType    = '';



		$dataRow = \dash\data::dataRow();
		$id = \dash\request::get('id');

		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);

		\dash\face::btnSave('formEditPost');

		\dash\face::btnSetting(\dash\url::this(). '/advance'. \dash\request::full_get());

		if(a($dataRow, 'status') === 'publish')
		{
			\dash\data::postViewLink(\dash\data::dataRow_link());
			\dash\face::btnView(\dash\data::dataRow_link());
		}
		else
		{
			\dash\data::postViewLink(\dash\data::dataRow_link(). '?preview=yes');
			\dash\face::btnPreview(\dash\data::postViewLink());
		}


		$myTitle     = T_("Edit post");
		$myBadgeLink = \dash\url::this(). $moduleType;
		$myBadgeText = T_('Back to list of posts');

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link($myBadgeLink);

		$myTitle = T_('Edit post');

		\dash\face::title($myTitle);

		$cmsSettingSaved = \lib\app\setting\get::cms_setting();
		\dash\data::cmsSettingSaved($cmsSettingSaved);


		switch (a($dataRow, 'subtype'))
		{
			case 'standard':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiostandard'));
				break;

			case 'gallery':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiogallery'));
				break;

			case 'video':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiovideo'));
				break;

			case 'audio':
				\lib\ratio::data_ratio_html(a($cmsSettingSaved, 'thumbratiopodcast'));
				break;

			default:
				# code...
				break;
		}


	}
}
?>
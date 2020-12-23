<?php
namespace content_cms\posts\edit;

class view
{
	public static function config()
	{
		\dash\data::myType(\dash\data::dataRow_type());


		$maxFileSize = 10;//\dash\upload\size::cms_file_size();
		\dash\data::maxFileSize($maxFileSize);


		$moduleTypeTxt = \dash\data::myType();
		$moduleType    = '';

		if(\dash\data::myType())
		{
			$moduleType = '?type='. \dash\data::myType();
		}

		$dataRow = \dash\data::dataRow();
		$id = \dash\request::get('id');

		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);

		\dash\face::btnSave('formEditPost');

		\dash\face::btnSetting(\dash\url::this(). '/setting'. \dash\request::full_get());

		if(a($dataRow, 'status') === 'publish')
		{
			\dash\face::btnView(\dash\data::dataRow_link());
		}
		else
		{
			\dash\face::btnPreview(\dash\data::dataRow_link(). '?preview=yes');
		}


		$myTitle     = T_("Edit post");
		$myBadgeLink = \dash\url::this(). $moduleType;
		$myBadgeText = T_('Back to list of posts');

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link($myBadgeLink);

		$myType = \dash\data::myType();

		if($myType === 'page')
		{
			$myTitle  = T_('Edit page');
			$pageList = \dash\db\posts::get(['type' => 'page', 'language' => \dash\language::current(), 'status' => ["NOT IN", "('deleted')"]]);
			$pageList = array_map(['\\dash\\app\\posts\\ready', 'row'], $pageList);
			\dash\data::pageList($pageList);
		}
		else
		{
			$myTitle = T_('Edit post');
		}

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


		\dash\data::allTagList(\dash\app\terms\get::get_all_tag());
		\dash\data::listCategory(\dash\app\terms\get::cat_list());

		\dash\data::tagsSavedTitle([]);
		\dash\data::listSavedCat([]);

		if(is_array(\dash\data::dataRow_tags()))
		{
			\dash\data::tagsSavedTitle(array_column(\dash\data::dataRow_tags(), 'title'));
		}


		if(is_array(\dash\data::dataRow_category()))
		{
			\dash\data::listSavedCat(array_column(\dash\data::dataRow_category(), 'term_id'));
		}

	}
}
?>
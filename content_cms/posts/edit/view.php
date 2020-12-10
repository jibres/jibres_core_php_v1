<?php
namespace content_cms\posts\edit;

class view
{
	public static function config()
	{
		\dash\data::myType(\dash\data::dataRow_type());

		$moduleTypeTxt = \dash\data::myType();
		$moduleType    = '';

		if(\dash\data::myType())
		{
			$moduleType = '?type='. \dash\data::myType();
		}

		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);

		\dash\face::btnSave('formEditPost');

		\dash\face::btnSetting(\dash\url::this(). '/setting'. \dash\request::full_get());

		\dash\face::btnView(\dash\data::dataRow_link());


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


		$productImageRatioHtml = 'data-ratio=1 data-ratio-free';
		// if(isset($productSettingSaved['ratio_detail']['ratio']))
		// {
		// 	$productImageRatioHtml = 'data-ratio='. $productSettingSaved['ratio_detail']['ratio'];
		// }
		\dash\data::productImageRatioHtml($productImageRatioHtml);
		\dash\data::allTagList(\dash\app\term::get_all_tag());
		\dash\data::listCategory(\dash\app\term::cat_list());

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
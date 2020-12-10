<?php
namespace content_cms\posts\add;

class view
{
	public static function config()
	{
		$moduleTypeTxt = \dash\request::get('type');
		$moduleType    = '';

		if(\dash\request::get('type'))
		{
			$moduleType = '?type='. \dash\request::get('type');
		}


		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);


		$myTitle   = T_("Add new post");

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). $moduleType);

		$myType = \dash\request::get('type');

		if($myType === 'page')
		{
			$myTitle = T_('Add new page');
			$pageList = \dash\db\posts::get(['type' => 'page', 'language' => \dash\language::current(), 'status' => ["NOT IN", "('deleted')"]]);
			$pageList = array_map(['\\dash\\app\\posts\\ready', 'row'], $pageList);
			\dash\data::pageList($pageList);
		}


		\dash\data::listCats(\dash\app\term::cat_list());


		\dash\face::title($myTitle);

	}
}
?>
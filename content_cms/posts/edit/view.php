<?php
namespace content_cms\posts\edit;

class view
{
	public static function config()
	{
		\content_cms\posts\main\view::myDataType();

		$moduleTypeTxt = \dash\data::myDataType();
		$moduleType    = '';

		if(\dash\data::myDataType())
		{
			$moduleType = '?type='. \dash\data::myDataType();
		}



		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);


		$myTitle = T_("Edit post");

		$myBadgeLink = \dash\url::this(). $moduleType;
		$myBadgeText = T_('Back to list of posts');

		$myType = \dash\data::myDataType();

		if($myType)
		{
			switch ($myType)
			{
				case 'page':
					\dash\permission::access('cpPageEdit');

					$myTitle = T_('Edit page');
					$myBadgeText = T_('Back to list of pages');

					$pageList = \dash\db\posts::get(['type' => 'page', 'language' => \dash\language::current(), 'status' => ["NOT IN", "('deleted')"]]);
					$pageList = array_map(['\dash\app\posts', 'ready'], $pageList);

					\dash\data::pageList($pageList);
					break;

				case 'help':
					\dash\permission::access('cpHelpCenterEdit');
					$myTitle     = T_('Edit help');
					$myBadgeText = T_('Back to list of helps');
					\dash\data::listCats(\dash\app\term::cat_list('help'));
					$pageList = \dash\db\posts::get(['type' => 'help', 'language' => \dash\language::current(), 'status' => ["NOT IN", "('deleted')"]]);
					$pageList = array_map(['\dash\app\posts', 'ready'], $pageList);
					\dash\data::pageList($pageList);
					break;


				case 'post':
				default:

					\dash\permission::access('cpPostsEdit');
					\dash\data::listCats(\dash\app\term::cat_list());

					\dash\data::listSpecial(\dash\app\posts\special::list());

					$myTitle = T_('Edit post');
					$myBadgeText = T_('Back to list of posts');
					break;
			}
		}
		else
		{
			\dash\permission::access('cpPostsEdit');
		}

		\dash\face::title($myTitle);

		\dash\data::action_text($myBadgeText);
		\dash\data::action_link($myBadgeLink);


		if(\dash\permission::check('cpChangePostCreator'))
		{
			$user_list = \dash\app\posts::get_user_can_write_post(\dash\data::myDataType());
			\dash\data::postAdder($user_list);
			if(is_array($user_list))
			{
				$allUserAuthorId = array_column($user_list, 'id');
				\dash\data::allUserAuthorId($allUserAuthorId);
			}
		}

		$creator = \dash\data::dataRow_user_id();
		$creator = \dash\coding::decode($creator);
		if($creator)
		{
			$user_detail = \dash\db\users::get_by_id($creator);
			$user_detail = \dash\app\user::ready($user_detail);
			\dash\data::userAuthorPost($user_detail);
		}

	}
}
?>

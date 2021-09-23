<?php
namespace content_a\setting\menu\item;



class view
{
	public static function config()
	{
		$editMode     = \dash\data::editMode();
		$addChildMode = \dash\data::addChildMode();

		$title        = null;

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/roster?'. \dash\request::build_query(['id' => \dash\request::get('id')]));

		if($editMode)
		{
			$title = T_("Edit item");
			\dash\face::title($title);
		}
		elseif($addChildMode)
		{
			$title = T_("Add child to");
			\dash\face::title($title);
			$title .= ' '. \dash\data::dataRowParent_title();
		}
		else
		{
			$title = T_("Add menu item");
			\dash\face::title($title);
			$title .= ' '. \dash\data::menuDetail_title();

			$child_count = \lib\app\menu\get::child_count(\dash\request::get('id'));
			if(!$child_count)
			{
				\dash\data::back_link(\dash\url::this(). '/menu');
			}
		}

		\dash\data::myFullPageTitle($title);


		// 'homepage','products','posts','forms','tags','hashtag','socialnetwork','other'

		$dataRow = \dash\data::dataRow();
		if(isset($dataRow['pointer']) && $dataRow['pointer'] === 'products' && isset($dataRow['related_id']) && $dataRow['related_id'])
		{
			$loadProduct = \lib\app\product\get::get($dataRow['related_id']);

			if(isset($loadProduct['title']))
			{
				\dash\data::productTitle($loadProduct['title']);
			}
		}

		if(isset($dataRow['pointer']) && $dataRow['pointer'] === 'posts' && isset($dataRow['related_id']) && $dataRow['related_id'])
		{
			$loadPost = \dash\app\posts\get::get(\dash\coding::encode($dataRow['related_id']));
			if(isset($loadPost['title']))
			{
				\dash\data::postTitle($loadPost['title']);
			}
		}


		if(isset($dataRow['pointer']) && $dataRow['pointer'] === 'pages' && isset($dataRow['related_id']) && $dataRow['related_id'])
		{
			$loadPost = \dash\app\posts\get::get(\dash\coding::encode($dataRow['related_id']));
			if(isset($loadPost['title']))
			{
				\dash\data::postTitle($loadPost['title']);
			}
		}

		if(isset($dataRow['pointer']) && $dataRow['pointer'] === 'tags' && isset($dataRow['related_id']) && $dataRow['related_id'])
		{
			$loadTag = \lib\app\tag\get::get($dataRow['related_id']);
			if(isset($loadTag['title']))
			{
				\dash\data::tagTitle($loadTag['title']);
			}
		}


		if(isset($dataRow['pointer']) && $dataRow['pointer'] === 'hashtag' && isset($dataRow['related_id']) && $dataRow['related_id'])
		{
			$loadHashtag = \dash\app\terms\get::get(\dash\coding::encode($dataRow['related_id']));
			if(isset($loadHashtag['title']))
			{
				\dash\data::hashtagTitle($loadHashtag['title']);
			}
		}



		if(isset($dataRow['pointer']) && $dataRow['pointer'] === 'forms' && isset($dataRow['related_id']) && $dataRow['related_id'])
		{
			$loadForm = \lib\app\form\form\get::get($dataRow['related_id']);
			if(isset($loadForm['title']))
			{
				\dash\data::formTitle($loadForm['title']);
			}
		}

	}
}
?>

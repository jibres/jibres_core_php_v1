<?php
namespace content_a\website\menu\item;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Add menu items'));


		$list = \dash\data::menuDetail_list();

		if(!$list || !is_array($list))
		{
			$list = [];
		}

		\dash\data::menuDetailList($list);

		$dataRow = \dash\data::dataRow();
		if(isset($dataRow['product_id']))
		{
			$loadProduct = \lib\app\product\get::get($dataRow['product_id']);
			if(isset($loadProduct['title']))
			{
				\dash\data::productTitle($loadProduct['title']);
			}
		}

		if(isset($dataRow['post_id']))
		{
			$loadPost = \dash\app\posts\get::get($dataRow['post_id']);
			if(isset($loadPost['title']))
			{
				\dash\data::postTitle($loadPost['title']);
			}
		}

		if(isset($dataRow['tag_id']))
		{
			$loadTag = \dash\app\terms\get::get($dataRow['tag_id']);
			if(isset($loadTag['title']))
			{
				\dash\data::tagTitle($loadTag['title']);
			}
		}


		if(isset($dataRow['hashtag_id']))
		{
			$loadHashtag = \lib\app\tag\get::get($dataRow['hashtag_id']);
			if(isset($loadHashtag['title']))
			{
				\dash\data::hashtagTitle($loadHashtag['title']);
			}
		}

		if($list)
		{
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::that(). '/roster'. \dash\request::full_get(['key' => null]));
		}
		else
		{
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/menu');
		}


	}
}
?>

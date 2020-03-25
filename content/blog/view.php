<?php
namespace content\blog;


class view
{
	public static function config()
	{
		\dash\face::desc(T_('Know about our stories and events'));
		\dash\data::allPostList(\dash\app\posts::get_post_list(['pagenation' => true]));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>

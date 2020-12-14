<?php
namespace content_cms\tag\remove;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Remove tag'));

		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);


		$tag_list = \dash\app\terms\get::get_all_tag();

		$tag_list = array_reverse($tag_list);
		\dash\data::listTag($tag_list);
	}
}
?>
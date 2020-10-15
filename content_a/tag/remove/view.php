<?php
namespace content_a\tag\remove;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Remove tag'));

		if(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\face::title(). ' | '. \dash\data::dataRow_title());
		}

		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);


		$tag_list = \lib\app\tag\get::all_tag();
		$tag_list = array_reverse($tag_list);
		\dash\data::listTag($tag_list);
	}
}
?>
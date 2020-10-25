<?php
namespace content_a\form\analytics\tag;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));

		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());

		\dash\data::fields($fields);




		$all_tag = \lib\app\form\tag\get::all_tag();
		\dash\data::allTagList($all_tag);




	}



}
?>

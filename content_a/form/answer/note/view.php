<?php
namespace content_a\form\answer\note;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit note'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that() . '/detail?id='. \dash\request::get('id'). '&aid='. \dash\request::get('aid'));

	}

}
?>

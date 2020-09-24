<?php
namespace content_a\form\analytics\remove;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Remove analytics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));
	}

}
?>

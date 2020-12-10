<?php
namespace content_cms\posts\gallerysort;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Sort images in gallery"));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

	}
}
?>
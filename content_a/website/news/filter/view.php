<?php
namespace content_a\website\news\filter;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Filter posts'));

		\dash\face::btnSave('form1');

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). \dash\request::full_get());

		\dash\data::listTag(\dash\app\terms\get::get_all_tag());


	}
}
?>

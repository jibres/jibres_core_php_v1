<?php
namespace content_a\form\analytics;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));


		$allFilter = \lib\app\form\filter\get::all_form_filter(\dash\request::get('id'));

		\dash\data::allFilter($allFilter);

	}

}
?>

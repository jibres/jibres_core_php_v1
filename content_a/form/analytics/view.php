<?php
namespace content_a\form\analytics;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();

		\dash\face::btnSetting(\dash\url::that(). '/remove?id='. \dash\request::get('id'));

		$allFilter = \lib\app\form\filter\get::all_form_filter(\dash\request::get('id'));

		\dash\data::allFilter($allFilter);

	}

}
?>

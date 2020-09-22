<?php
namespace content_a\form\analytics\addcondition;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add condition'). ' | '. \dash\data::filterDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/filter?'. \dash\request::fix_get());


		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());

		\dash\data::fields($fields);

	}

}
?>

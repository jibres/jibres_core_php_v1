<?php
namespace content_a\form\condition;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Form condition'). ' | '. \dash\data::filterDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?'. \dash\request::fix_get());


		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());

		\dash\data::fields($fields);

	}

}
?>

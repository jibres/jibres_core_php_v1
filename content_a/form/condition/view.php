<?php
namespace content_a\form\condition;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Form condition'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?'. \dash\request::fix_get());

		$item = \lib\app\form\item\get::items_conditionable(\dash\request::get('id'));

		\dash\data::items($item);


		if(\dash\request::get('item') && is_array($item))
		{
			$load_choice = [];

			foreach ($item as $key => $value) {
				// code...
			}
		}


	}

}
?>

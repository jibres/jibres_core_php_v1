<?php
namespace content_a\form\analytics\addcondition;


class controller
{
	public static function routing()
	{

		$form_id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($form_id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::formDetail($load);

		$filter_id = \dash\request::get('fid');

		if(!$filter_id)
		{
			\dash\redirect::to(\dash\url::that(). '/addfilter?id='. \dash\request::get('id'));
		}

		$load_filter = \lib\app\form\filter\get::get($filter_id);
		if(!$load_filter)
		{
			\dash\header::status(404);
		}

		\dash\data::filterDetail($load_filter);


		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail(), true);

		\dash\data::fields($fields);

		if(\dash\request::get('field'))
		{
			$field = \dash\request::get('field');

			if(isset($fields[$field]['item_id']) && $fields[$field]['item_id'])
			{
				$load_item = \lib\app\form\item\get::get($fields[$field]['item_id']);
				\dash\data::itemDetail($load_item);

			}

		}
	}

}
?>

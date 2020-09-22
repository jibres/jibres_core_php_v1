<?php
namespace content_a\form\analytics\export;


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

		if($filter_id)
		{
			$load_filter = \lib\app\form\filter\get::get($filter_id);
			if(!$load_filter)
			{
				\dash\header::status(404);
			}

			\dash\data::filterDetail($load_filter);
		}
	}

}
?>

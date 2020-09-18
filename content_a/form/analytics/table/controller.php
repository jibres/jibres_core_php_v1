<?php
namespace content_a\form\analytics\table;


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


		$view_id = \dash\request::get('vid');

		$load_view = \lib\app\form\view\get::get($view_id);
		if(!$load_view)
		{
			\dash\header::status(404);
		}

		\dash\data::viewDetail($load_view);




		$load_view_field = \lib\app\form\view\field::get_by_view_id($view_id);
		if(!$load_view_field)
		{
			\dash\header::status(404);
		}

		\dash\data::viewFieldDetail($load_view_field);




	}

}
?>

<?php
namespace content_a\form\answer\edit;


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


		\dash\allow::file();

	}

}
?>

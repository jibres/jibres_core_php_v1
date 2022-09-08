<?php
namespace content_a\form\find\print;


class controller
{
	public static function routing()
	{
		if(!\lib\app\form\form\get::enterpriseSpecialFormBuilder())
		{
			\dash\header::status(404);
		}

		$id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::forDetail($load);


	}
}
?>

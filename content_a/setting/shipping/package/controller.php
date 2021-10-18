<?php
namespace content_a\setting\shipping\package;

class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		if($id)
		{
			$load = \lib\app\setting\package::load($id);
			if(!$load)
			{
				\dash\header::status(404);
			}

			\dash\data::dataRow($load);
			\dash\data::editMode(true);
		}

	}
}
?>
<?php
namespace content_a\setting\fund;

class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		if($id)
		{
			$load = \lib\app\fund\get::get($id);
			if(!$load)
			{
				\dash\header::status(403, T_("Invalid id"));
			}

			\dash\data::editMode(true);
			\dash\data::dataRow($load);
		}
	}
}
?>
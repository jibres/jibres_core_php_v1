<?php
namespace content_a\setting\units;

class controller
{
	public static function routing()
	{
		$unitList = \lib\app\product\unit::list();
		\dash\data::dataTable($unitList);

		$edit = \dash\request::get('edit');
		if($edit && !array_key_exists($edit, $unitList))
		{
			\dash\header::status(403, T_("Invalid unit"));
		}

		if(isset($unitList[$edit]))
		{
			\dash\data::productCount($unitList[$edit]);
		}

		if(is_array($_GET) && array_key_exists('edit', $_GET))
		{
			\dash\data::editMode(true);
		}
	}
}
?>
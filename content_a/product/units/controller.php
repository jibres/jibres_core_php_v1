<?php
namespace content_a\product\units;

class controller
{
	public static function routing()
	{
		\dash\permission::access('productUnitListView');

		$unitList = \lib\app\product\unit::list(true);
		\dash\data::dataTable($unitList);

		$edit = \dash\request::get('edit');
		if($edit && !array_key_exists($edit, $unitList))
		{
			\dash\header::status(403, T_("Invalid unit"));
		}

		if(isset($unitList[$edit]))
		{
			\dash\data::dataRow($unitList[$edit]);
		}

		if(is_array($_GET) && array_key_exists('edit', $_GET))
		{
			\dash\permission::access('productUnitListEdit');
			\dash\data::editMode(true);
		}
	}
}
?>
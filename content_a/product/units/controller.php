<?php
namespace content_a\product\units;

class controller
{
	public static function routing()
	{
		if(\dash\request::get('id'))
		{
			\dash\data::editMode(true);
			$id      = \dash\request::get('id');
			$dataRow = \lib\app\product\unit::get($id);

			if(!$dataRow)
			{
				\dash\header::status(404, T_("Invalid product unit id"));
			}

			\dash\data::dataRow($dataRow);
		}
		else
		{
			$unitList = \lib\app\product\unit::list(true);
			\dash\data::dataTable($unitList);1
		}


	}
}
?>
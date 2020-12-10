<?php
namespace content_cms\terms;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('edit'))
		{
			\dash\data::editMode(true);

			$id = \dash\request::get('edit');
			$dataRow = \dash\app\term::get($id);
			\dash\data::dataRow($dataRow);

			if(!$dataRow)
			{
				\dash\header::status(404, T_("Id not found"));
			}
		}
	}
}
?>

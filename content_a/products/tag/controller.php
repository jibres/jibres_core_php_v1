<?php
namespace content_a\products\tag;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('edit'))
		{
			\dash\data::editMode(true);

			$id = \dash\request::get('edit');
			$datarow = \dash\app\term::get($id);
			\dash\data::datarow($datarow);

			if(!$datarow)
			{
				\dash\header::status(404, T_("Id not found"));
			}
		}
	}
}
?>

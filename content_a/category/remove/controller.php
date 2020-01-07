<?php
namespace content_a\category\remove;

class controller
{
	public static function routing()
	{
		\dash\permission::access('categoryRemove');

		$dataRow = \lib\app\product\cat::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404);
		}

	}
}
?>
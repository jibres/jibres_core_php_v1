<?php
namespace content_a\category\remove;

class controller
{
	public static function routing()
	{
		\dash\header::status(403, 'NTFX');

		\dash\permission::access('categoryRemove');

		$dataRow = \lib\app\product\category::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404);
		}

	}
}
?>
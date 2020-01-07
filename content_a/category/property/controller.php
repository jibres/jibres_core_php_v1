<?php
namespace content_a\category\property;

class controller
{
	public static function routing()
	{
		\dash\permission::access('categoryPropertyAddEdit');

		$dataRow = \lib\app\product\cat::get(\dash\request::get('id'));
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404);
		}

	}
}
?>
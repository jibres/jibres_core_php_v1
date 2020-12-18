<?php
namespace content_love\store\setting;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$load = \lib\app\store\get::by_id($id);

		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

		$data = \lib\app\store\get::data_by_id($id);
		\dash\data::dataRowData($data);

	}
}
?>

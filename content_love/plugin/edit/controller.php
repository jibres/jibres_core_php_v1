<?php
namespace content_love\plugin\edit;


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

		$pid = \dash\request::get('pid');
		$plugin = \lib\app\plugin\business::load_by_id($pid);
		if(!$plugin)
		{
			\dash\header::status(403, T_("Plugin id not found"));
		}

		\dash\data::pluginDataRow($plugin);

	}
}
?>

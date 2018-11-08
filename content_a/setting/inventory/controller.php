<?php
namespace content_a\setting\inventory;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditInventory');

		if(\dash\request::get('inventory'))
		{
			$dataRow = \lib\app\inventory::get(\dash\request::get('inventory'));
			if(!$dataRow)
			{
				\dash\header::status(403, T_("Invalid inventory id"));
			}

			\dash\data::dataRow($dataRow);
		}
	}
}
?>
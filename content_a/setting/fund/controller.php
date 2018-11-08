<?php
namespace content_a\setting\fund;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditFund');
		if(\dash\request::get('id'))
		{
			$dataRow = \lib\app\fund::get(\dash\request::get('id'));
			if(!$dataRow)
			{
				\dash\header::status(403, T_("Invalid fund id"));
			}

			\dash\data::dataRow($dataRow);
		}
	}
}
?>
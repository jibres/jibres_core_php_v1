<?php
namespace content_cms\attachment\view;

class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');
		$load = \dash\app\files\get::get($id);

		if(!$load)
		{
			\dash\header::status(404, T_("Invalid file id"));
		}

		\dash\data::dataRow($load);

	}
}
?>
<?php
namespace content_love\files\view;

class controller
{
	public static function routing()
	{
		\dash\permission::access('cmsManageAttachment');

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
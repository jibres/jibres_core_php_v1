<?php
namespace content_a\form\tag\edit;

class controller
{
	public static function routing()
	{
		\content_a\form\tag\controller::check_form_id();

		\dash\permission::access('tagEdit');

		$dataRow = \lib\app\form\tag\get::get(\dash\request::get('tid'));
		\dash\data::dataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid tag id"));
		}

	}
}
?>
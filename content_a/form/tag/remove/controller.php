<?php
namespace content_a\form\tag\remove;

class controller
{
	public static function routing()
	{
		\content_a\form\tag\controller::check_form_id();
		\content_a\form\tag\controller::loadForm();


		$dataRow = \lib\app\form\tag\get::get(\dash\request::get('tid'));
		\dash\data::tagDataRow($dataRow);

		if(!$dataRow)
		{
			\dash\header::status(404, T_("Invalid tag id"));
		}

	}
}
?>
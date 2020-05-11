<?php
namespace content_a\website\body\edit;


class controller
{
	public static function routing()
	{
		$id = \dash\request::post('id');

		$load_line_detail = \lib\app\website\body\get::line_setting($id);

		if(!$load_line_detail)
		{
			\dash\header::status(404, T_("Line id is not valid!"));
		}

		\dash\data::lineSetting($load_line_detail);
	}
}
?>

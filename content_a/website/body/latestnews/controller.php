<?php
namespace content_a\website\body\latestnews;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$load_line_detail = \lib\app\website\body\get::line_setting($id);

		if(!$load_line_detail)
		{
			\dash\header::status(404, T_("Line id is not valid!"));
		}

		\dash\data::lineSetting($load_line_detail);


		if(\dash\data::lineSetting_id() !== 'latestnews')
		{
			\dash\header::status(403, T_("This line is not a latest news!"));
		}

	}
}
?>

<?php
namespace content_a\website\body\latestnews;


class controller
{
	public static function routing()
	{
		$key = \dash\request::get('key');

		$load_line_detail = \lib\app\website\body\get::line_option($key);
		if(!$load_line_detail)
		{
			\dash\header::status(404, T_("Line key is not valid!"));
		}

		\dash\data::lineOption($load_line_detail);


		if(\dash\data::lineOption_key() !== 'latestnews')
		{
			\dash\header::status(403, T_("This line is not a latestnews!"));
		}

	}
}
?>

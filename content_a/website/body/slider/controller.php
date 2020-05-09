<?php
namespace content_a\website\body\slider;


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


		if(\dash\data::lineOption_key() !== 'slider')
		{
			\dash\header::status(403, T_("This line is not a slider!"));
		}

		$index = \dash\request::get('index');

		if(is_numeric($index))
		{
			$saved_option = \lib\app\website\body\slider::get(\dash\request::get('key'));
			\dash\data::savedOption($saved_option);

			if(!array_key_exists($index, $saved_option))
			{
				\dash\header::status(403, T_("Invalid index of slider!"));
			}

			\dash\data::dataRow($saved_option[$index]);
		}
	}
}
?>

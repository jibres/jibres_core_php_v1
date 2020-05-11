<?php
namespace content_a\website\body\slider;


class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');

		if($id)
		{
			$load_line_detail = \lib\app\website\body\line\slider::get($id);

			if(!$load_line_detail)
			{
				\dash\header::status(404, T_("Line id is not valid!"));
			}

			\dash\data::lineSetting($load_line_detail);

			// use this id in model for edit
			\dash\data::sliderID(\dash\request::get('id'));

			$index = \dash\request::get('index');

			if(is_numeric($index))
			{
				$saved_option = \lib\app\website\body\slider::get(\dash\request::get('id'));
				\dash\data::savedOption($saved_option);

				if(!array_key_exists($index, $saved_option))
				{
					\dash\header::status(403, T_("Invalid index of slider!"));
				}

				\dash\data::dataRow($saved_option[$index]);
			}
		}
	}
}
?>

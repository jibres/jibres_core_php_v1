<?php
namespace content_a\website\slider\add;


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
				if(isset($load_line_detail['slider']) && is_array($load_line_detail['slider']) && array_key_exists($index, $load_line_detail['slider']))
				{
					// ok
					\dash\data::dataRow($load_line_detail['slider'][$index]);
				}
				else
				{
					\dash\header::status(403, T_("Invalid index of slider!"));
				}
			}
		}
	}
}
?>

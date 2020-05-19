<?php
namespace content_a\website\slider\setting;


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
		}

	}
}
?>

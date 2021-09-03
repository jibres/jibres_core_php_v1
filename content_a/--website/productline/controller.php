<?php
namespace content_a\website\productline;


class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');

		if($id)
		{
			$load_line_detail = \lib\app\website\body\line\productline::get($id);

			if(!$load_line_detail)
			{
				\dash\header::status(404, T_("Line id is not valid!"));
			}

			\dash\data::lineSetting($load_line_detail);

			if(isset($load_line_detail['productline']))
			{
				\dash\data::dataRow($load_line_detail['productline']);
			}

			// use this id in model for edit
			\dash\data::productlineID(\dash\request::get('id'));

			$index = \dash\request::get('index');

			if(is_numeric($index))
			{
				if(isset($load_line_detail['productline']) && is_array($load_line_detail['productline']) && array_key_exists($index, $load_line_detail['productline']))
				{
					// ok
					\dash\data::dataRow($load_line_detail['productline'][$index]);
				}
				else
				{
					\dash\header::status(403, T_("Invalid index of productline!"));
				}

			}
		}
	}
}
?>

<?php
namespace content_a\website\imageblock\add;


class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');

		if($id)
		{
			$load_line_detail = \lib\app\website\body\line\imageblock::get($id);

			if(!$load_line_detail)
			{
				\dash\header::status(404, T_("Line id is not valid!"));
			}

			\dash\data::lineSetting($load_line_detail);

			// use this id in model for edit
			\dash\data::imageblockID(\dash\request::get('id'));

			$index = \dash\request::get('index');

			if(is_numeric($index))
			{
				if(isset($load_line_detail['imageblock']) && is_array($load_line_detail['imageblock']) && array_key_exists($index, $load_line_detail['imageblock']))
				{
					// ok
					\dash\data::dataRow($load_line_detail['imageblock'][$index]);
				}
				else
				{
					\dash\header::status(403, T_("Invalid index of imageblock!"));
				}
			}
		}
	}
}
?>

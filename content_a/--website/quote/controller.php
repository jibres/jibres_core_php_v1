<?php
namespace content_a\website\quote;


class controller
{
	public static function routing()
	{

		$id = \dash\request::get('id');

		if($id)
		{
			$load_line_detail = \lib\app\website\body\line\quote::get($id);

			if(!$load_line_detail)
			{
				\dash\header::status(404, T_("Line id is not valid!"));
			}

			\dash\data::lineSetting($load_line_detail);

			// use this id in model for edit
			\dash\data::quoteID(\dash\request::get('id'));

			$index = \dash\request::get('index');

			if(is_numeric($index))
			{
				if(isset($load_line_detail['quote']) && is_array($load_line_detail['quote']) && array_key_exists($index, $load_line_detail['quote']))
				{
					// ok
					\dash\data::dataRow($load_line_detail['quote'][$index]);
				}
				else
				{
					\dash\header::status(403, T_("Invalid index of quote!"));
				}

			}
		}
		else
		{
			\dash\redirect::to(\dash\url::this(). '/quote/add?id='. \dash\data::quoteID());
		}
	}
}
?>

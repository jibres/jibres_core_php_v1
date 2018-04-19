<?php
namespace content_a\product\edit;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('id'))
		{
			\dash\redirect::to(\dash\url::this(). '/general?id='. \dash\request::get('id'));
		}
		else
		{
			\dash\header::status(404, T_("Id not set!"));
		}

	}
}
?>

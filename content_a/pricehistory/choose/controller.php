<?php
namespace content_a\pricehistory\choose;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('id'))
		{
			\dash\redirect::to(\dash\url::this(). '?id='. \dash\request::get('id'));
		}


	}
}
?>

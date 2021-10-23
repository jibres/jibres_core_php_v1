<?php
namespace content_a\category\clone;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$result = \lib\app\category\edit::clone(\dash\request::post('clone'),  $id);

		if($result)
		{
			\dash\redirect::to(\dash\url::this(). '/property'. \dash\request::full_get());
		}


	}
}
?>
<?php
namespace content_a\tag\editgroup;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$result = \lib\app\tag\edit::edit_group(\dash\request::post('cat'), \dash\request::get('group'), $id);

		if($result)
		{
			\dash\redirect::to(\dash\url::this(). '/property'. \dash\request::full_get(['group' => null]));
		}


	}
}
?>
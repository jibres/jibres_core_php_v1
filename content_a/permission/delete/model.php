<?php
namespace content_a\permission\delete;


class model
{
	public static function post()
	{
		\dash\permission::access('aPermissionDelete');

		$name   = \dash\request::get('id');
		$delete = \dash\permission::delete_permission($name);
		if($delete)
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>
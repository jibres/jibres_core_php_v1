<?php
namespace content_a\products\comment;

class model
{
	public static function post()
	{
		$status = \dash\request::post('status');
		$id     = \dash\request::post('id');


		if(!$status || !$id)
		{
			\dash\notif::warn(T_("Invalid detail"));
			return false;
		}

		$post_detail = \lib\app\product\comment::edit(['status' => $status], $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

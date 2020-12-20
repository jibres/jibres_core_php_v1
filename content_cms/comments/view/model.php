<?php
namespace content_cms\comments\view;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\dash\app\comment\remove::remove(\dash\request::get('id'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}

			return;
		}


		$status = \dash\request::post('status');

		if(!$status)
		{
			\dash\notif::error(T_("Invalid status"));
			return false;
		}

		$update =['status'  => $status,];

		$post_detail = \dash\app\comment\edit::edit_status($update, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

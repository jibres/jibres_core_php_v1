<?php
namespace content_a\products\comment\edit;

class model
{
	public static function post()
	{
		$status = \dash\request::post('status');

		if(!$status)
		{
			\dash\notif::error(T_("Invalid status"));
			return false;
		}

		$update =
		[
			'content' => \dash\request::post('content'),

			'status'  => \dash\request::post('status'),
			'title'  => \dash\request::post('title'),

		];


		$post_detail = \lib\app\product\comment::edit($update, \dash\request::get('cid'));

		if(\dash\engine\process::status())
		{
			\dash\log::set('commandEdit', ['code' => \dash\request::get('cid')]);

			\dash\redirect::pwd();
		}
	}
}
?>

<?php
namespace content_cms\comments\edit;

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
			'author'  => \dash\request::post('author'),
			'email'   => \dash\request::post('email'),
			'status'  => \dash\request::post('status'),
			'mobile'  => \dash\request::post('mobile'),
			'url'     => \dash\request::post('website'),
		];


		$post_detail = \dash\app\comment::edit($update, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\log::set('commandEdit', ['code' => \dash\request::get('id')]);
			\dash\notif::ok(T_("Comment successfully updated"));
			\dash\redirect::pwd();
		}
	}
}
?>

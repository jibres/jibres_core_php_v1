<?php
namespace content_a\order\status;


class model
{

	public static function post()
	{
		\dash\notif::warn(T_("Not ready"));
		// $post =
		// [
		// 	'desc' => \dash\request::post('desc'),
		// ];


		// \lib\app\factor\edit::edit_factor($post, \dash\request::get('id'));

		// if(\dash\engine\process::status())
		// {
		// 	\dash\redirect::pwd();
		// }
	}
}
?>

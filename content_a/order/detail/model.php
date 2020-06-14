<?php
namespace content_a\order\detail;


class model
{

	public static function post()
	{
		$post                = [];
		$post['address_id']    = \dash\request::post('address');

		$order_id = \dash\request::get('id');

		\lib\app\factor\edit::edit_factor($post, $order_id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

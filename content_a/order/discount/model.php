<?php
namespace content_a\order\discount;


class model
{

	public static function post()
	{
		$post =
		[
			'discount' => \dash\request::post('discount'),
			'shipping' => \dash\request::post('shipping'),
		];


		\lib\app\factor\edit::edit_factor($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>

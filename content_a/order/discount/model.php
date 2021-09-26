<?php
namespace content_a\order\discount;


class model
{

	public static function post()
	{
		if(\dash\request::post('removediscount') === 'removediscount')
		{
			\lib\app\factor\edit::remove_discount_code(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
		if(\dash\request::post('adddiscount') === 'adddiscount')
		{
			\lib\app\factor\edit::add_discount_code(\dash\request::post('discount_code'), \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('updateshipping') === 'updateshipping')
		{
			$post =
			[

				'shipping' => \dash\request::post('shipping'),
			];


			\lib\app\factor\edit::edit_factor($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

	}
}
?>

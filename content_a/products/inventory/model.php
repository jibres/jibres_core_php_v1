<?php
namespace content_a\products\inventory;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post                  = [];

		$post['trackquantity'] = \dash\request::post('trackquantity');
		$post['oversale']      = \dash\request::post('oversale');
		$post['stock']         = \dash\request::post('stock');
		$post['minstock']      = \dash\request::post('minstock');
		$post['maxstock']      = \dash\request::post('maxstock');
		$post['sku']           = \dash\request::post('sku');

		\lib\app\product\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>
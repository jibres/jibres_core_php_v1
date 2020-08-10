<?php
namespace content_a\products\inventory;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		if(\dash\request::post('delete') === 'product')
		{
			$result = \lib\app\product\remove::product($id);
			if($result)
			{
				\dash\redirect::to(\lib\backlink::products());
			}
			return true;
		}

		if(\dash\request::post('setstatus') === 'setstatus')
		{
			$post                = [];

			$post['status']     = \dash\request::post('status');

			\lib\app\product\edit::edit($post, $id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

			return;
		}

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
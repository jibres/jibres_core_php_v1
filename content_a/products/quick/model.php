<?php
namespace content_a\products\quick;


class model
{
	public static function post()
	{

		$msg =	[];

		$post =
		[
			'title'         => \dash\request::post('title'),
			'price'         => \dash\request::post('price'),
			'discount'      => \dash\request::post('discount'),
			'vat'           => \dash\request::post('vat'),
			'buyprice'      => \dash\request::post('buyprice'),
			'barcode'       => \dash\request::post('barcode'),
			'barcode2'      => \dash\request::post('barcode2'),
			'trackquantity' => \dash\request::post('trackquantity'),
			'stock'         => \dash\request::post('stock'),
		];

		$id = \dash\request::get('id');

		if($id)
		{
			$result      = \lib\app\product\edit::edit($post, $id);
			$msg['fn']   = 'ProductEditedFunction';
			$msg['args'] = $id;
		}
		else
		{
			$result = \lib\app\product\add::add($post);

			if(\dash\engine\process::status())
			{
				$msg['fn']   = 'addProductByID';
				$msg['args'] = a($result, 'id');

				if(!\dash\request::is_iframe())
				{
					if(isset($result['id']))
					{
						\dash\redirect::to(\dash\url::that(). '?id='. $result['id']);
					}
					else
					{
						\dash\redirect::to(\dash\url::that());
					}
				}
			}
		}



		if(\dash\request::is_iframe() && \dash\engine\process::status())
		{
			$msg['type']  = 'closeAndRun';
			$msg['notif'] = \dash\notif::get_msg();

			\dash\notif::postMsg($msg);
		}

	}
}
?>
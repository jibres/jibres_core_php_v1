<?php
namespace content_a\products\quick;


class model
{
	public static function post()
	{

		// test
		$msg =
		[
			'hello' => 'everyone!',
			'type'  => 'closeAndRun',
			'fn'    => 'echo',
			'args'  => 'salam',
			'say'   => ['title' => 'abc', 'desc' => 'aaaaa'],
			'notif' => ['title' => 'abc', 'desc' => 'aaaaa'],
		];
		\dash\notif::postMsg($msg);


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
			$result = \lib\app\product\edit::edit($post, $id);
		}
		else
		{
			$result = \lib\app\product\add::add($post);

			if(\dash\engine\process::status())
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
}
?>
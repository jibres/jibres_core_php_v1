<?php
namespace content_a\buy\opr;


class model
{

	public static function post()
	{
		$product_id = \dash\request::post('product_id');
		$price      = \dash\request::post('price');
		$discount   = \dash\request::post('discount');
		$title      = \dash\request::post('title');
		$buyprice   = \dash\request::post('buyprice');

		if(!is_array($product_id))
		{
			\dash\notif::error(T_("Input must be array"));
			return false;
		}

		foreach ($product_id as $key => $id)
		{
			$update =
			[
				'title'    => a($title, $key),
				'price'    => a($price, $key),
				'discount' => a($discount, $key),
				'buyprice' => a($buyprice, $key),
			];


			\lib\app\product\edit::edit($update, $id);

			if(!\dash\engine\process::status())
			{
				return false;
			}

		}

		\dash\notif::clean();
		\dash\notif::ok(T_("Saved"));
		return true;
	}
}
?>

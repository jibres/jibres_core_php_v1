<?php
namespace content_a\order\address;


class view
{
	public static function config()
	{
		$address = a(\dash\data::orderDetail(), 'address');
      	\dash\data::dataRowAddress($address);

      	\content_a\order\view::master_order_view();
	}
}
?>

<?php
namespace content_a\buy\opr;


class controller extends \content_a\buy\controller
{
	public static function routing()
	{
		parent::routing();

		$id             = \dash\request::get('id');

		$load_buy_order = \lib\app\order\get::load_with_special_type($id, 'buy');

		if(!$load_buy_order)
		{
			\dash\header::status(403);
		}

		\dash\data::orderDetail($load_buy_order);
	}
}
?>

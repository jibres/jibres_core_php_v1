<?php
namespace content_a\sale;


class controller
{
	public static function routing()
	{

		if(\dash\url::module() === 'buy')
		{
			$type = 'buy';
			\dash\permission::access('factorBuyAdd');
		}
		else
		{
			$type = 'sale';
			\dash\permission::access('factorSaleAdd');
		}

		\dash\data::moduleType($type);



	}
}
?>

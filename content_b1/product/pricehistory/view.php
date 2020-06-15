<?php
namespace content_b1\product\pricehistory;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$chart = \lib\app\product\updateprice::chart($id, true);

		$specialDate = null;

		$date = \dash\request::get('date');
		if($date)
		{
			$specialDate = \lib\app\product\updateprice::special_date($id, $date);
			\dash\data::specialDate($specialDate);

		}

		\content_b1\tools::say(['cart' => $chart, 'special_date' => $specialDate]);
	}
}
?>
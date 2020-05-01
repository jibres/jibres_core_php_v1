<?php
namespace content_a\pricehistory;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Price change chart!'));

		\dash\data::script_page('/js/chart/a/pricehistory.js');

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		$id = \content_a\pricehistory\controller::myId();
		if($id)
		{
			$chart = \lib\app\product\updateprice::chart($id);
			\dash\data::cahrtDetail($chart);

			$date = \dash\request::get('date');
			if($date)
			{
				$specialDate = \lib\app\product\updateprice::special_date($id, $date);
				\dash\data::specialDate($specialDate);

			}
		}

	}
}
?>

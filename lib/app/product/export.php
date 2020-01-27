<?php
namespace lib\app\product;

class export
{

	public static function count_all()
	{
		$count_product_available = \lib\db\products\get::count_all();
		return intval($count_product_available);
	}


	public static function download_now()
	{
		$count_all = self::count_all();

		if($count_all > 50)
		{
			\dash\redirect::to(\dash\url::that());
		}
		else
		{
			$list = \lib\db\products\get::all_record_for_export();
			$list = array_map(['\\lib\\app\\product\\ready', 'export'], $list);
			\dash\utility\export::csv(['name' => 'products_'.date("Y_m_d"). '_'. $count_all, 'data' => $list]);
			return;
		}
	}
}
?>
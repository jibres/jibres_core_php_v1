<?php
namespace lib\app\admin_dashboard;

/**
 * get cache
 */
class get
{
	public static function get()
	{
		$result                   = [];
		$result['product_count']  = floatval(\lib\db\products\get::count_all_for_dashboard());
		$result['customer_count'] = floatval(\dash\db\users::count_ok_users());
		$result['staff_count']    = floatval(\dash\db\users::count_users_have_permission());
		$result['chart']          = self::sale_time_chart();

		$result['new_order']      = floatval(\lib\db\factors\get::count_new_order());
		$result['new_ticket']     = floatval(\dash\db\tickets\get::count_awaiting());
		$result['new_comment']    = floatval(\dash\app\comment\search::get_count_status('awaiting'));
		$result['new_form_answer']    = \lib\app\form\answer\get::need_review_form();

		$result['notif_count'] = \dash\app\log::my_notif_count();

		return $result;
	}



	private static function sale_time_chart()
	{

		$sale_time_chart = \lib\db\factors\chart::time_chart('sale');
		$temp = [];
		if(is_array($sale_time_chart))
		{
			foreach ($sale_time_chart as $key => $value)
			{
				$count = floatval($value['count']);
				$sum   = floatval($value['sum']);
				$sum   = floatval($sum);

				$temp[] = ['key' => \dash\fit::number($value['key']), 'count' => $count, 'sum' => $sum];
			}
		}
		$hi_chart               = [];
		$hi_chart['categories'] = json_encode(array_column($temp, 'key'), JSON_UNESCAPED_UNICODE);
		$hi_chart['count']      = json_encode(array_column($temp, 'count'), JSON_UNESCAPED_UNICODE);
		$hi_chart['sum']        = json_encode(array_column($temp, 'sum'), JSON_UNESCAPED_UNICODE);


		return $hi_chart;

	}
}
?>
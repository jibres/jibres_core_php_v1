<?php
namespace content_a\form\analytics\chart;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));


		$where_list = \lib\app\form\filter\get::where_list(\dash\request::get('fid'), \dash\request::get('id'));

		$chart = [];
		$last_count = null;
		$chart[] = [T_("All"), floatval(40881)];
		foreach ($where_list as $key => $value)
		{
			if(\dash\request::get('inside'))
			{
				$chart[] = [$value['field_title']. ' '. $value['condition_title'], floatval($value['inside'])];
			}
			else
			{
				$chart[] = [$value['field_title']. ' '. $value['condition_title'], floatval($value['outside'])];
			}
			$last_count = $value['count_after'];
		}
		$chart[] = [T_("Remain"), floatval($last_count)];
		$chart = json_encode($chart, JSON_UNESCAPED_UNICODE);
		\dash\data::chartDetail($chart);


	}

}
?>

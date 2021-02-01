<?php
namespace dash\app\files;


class dashboard
{

	public static function detail()
	{

		$dashboard_detail                  = [];
		$dashboard_detail['total_count']   = floatval(\dash\db\files::count_all());
		$dashboard_detail['total_size']    = floatval(\dash\db\files::total_size());
		$dashboard_detail['storage_limit'] = \dash\upload\storage::limit();

		$div = $dashboard_detail['storage_limit'];

		if(intval($div) === 0)
		{
			$div = 1;
		}

		$dashboard_detail['used_percent'] = round($dashboard_detail['total_size'] * 100 / $div, 2);

		if($dashboard_detail['used_percent'] > 100)
		{
			$dashboard_detail['used_percent'] = 100;
		}

		if(\dash\engine\store::inStore())
		{
			$dashboard_detail['upload_special_provider'] = \lib\store::detail('special_upload_provider');

			if($dashboard_detail['upload_special_provider'])
			{
				$load_provider = \lib\app\setting\get::upload_provider();
				foreach ($load_provider as $name => $provider)
				{
					if(isset($provider['status']) && $provider['status'])
					{
						$dashboard_detail['upload_provider_name'] = $name;
						break;
					}
				}
			}

		}
		else
		{
			$dashboard_detail['upload_special_provider'] = false;
		}

		$dashboard_detail['charttype']                   = self::chart($dashboard_detail['total_size'], $dashboard_detail['total_count']);

		return $dashboard_detail;
	}



	private static function chart($_total_size, $_total_count)
	{
		$get_count_size_per_type = \dash\db\files::chart_count_size_per_type();

		if(!is_array($get_count_size_per_type))
		{
			$get_count_size_per_type = [];
		}

		$result = [];
		foreach ($get_count_size_per_type as $key => $value)
		{
			$result[] = ['name' => T_(ucfirst($value['type'])), 'y' => floatval($value['count'])];
		}

		$chart             = [];
		$chart['category'] = json_encode(array_column($result, 'name') , JSON_UNESCAPED_UNICODE);
		$chart['data']     = json_encode(array_values($result), JSON_UNESCAPED_UNICODE);

		return $chart;
	}
}
?>
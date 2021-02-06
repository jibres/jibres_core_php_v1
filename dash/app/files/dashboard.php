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

		self::chart($dashboard_detail);

		return $dashboard_detail;
	}



	private static function chart(&$dashboard_detail)
	{
		$get_count_size_per_type = \dash\db\files::chart_count_size_per_type();

		if(!is_array($get_count_size_per_type))
		{
			$get_count_size_per_type = [];
		}

		$type_count =
		[
			'image'   => 0,
			'audio'   => 0,
			'video'   => 0,
			'archive' => 0,
			'pdf'     => 0,
			'other'   => 0,

			// 'pdf',
			// 'archive',
			// 'word',
			// 'excel',
			// 'powerpoint',
			// 'code',
			// 'text',
			// 'file',
		];
		$count = [];
		$size  = [];

		foreach ($get_count_size_per_type as $key => $value)
		{
			if(isset($type_count[$value['type']]))
			{
				$type_count[$value['type']] += floatval($value['count']);
			}
			else
			{
				$type_count['other'] += floatval($value['count']);
			}

			$count[] = ['name' => T_(ucfirst($value['type'])), 'y' => floatval($value['count'])];
			$size[]  = ['name' => T_(ucfirst($value['type'])), 'y' => round(floatval($value['size']) / 1024 / 1024)];
		}

		$chart                             = [];

		$chart['data']                     = json_encode($count, JSON_UNESCAPED_UNICODE);

		$chart_size                        = [];

		$chart_size['data']                = json_encode($size, JSON_UNESCAPED_UNICODE);

		$dashboard_detail['charttypesize'] = $chart_size;
		$dashboard_detail['charttype']     = $chart;
		$dashboard_detail['type_count']    = $type_count;


	}
}
?>
<?php
namespace lib\app\store;


class stats_monthly
{
	public static function calculate()
	{
		\dash\code::time_limit(0);

		self::clean_all();

		self::calc_store();

		$list = \lib\db\store\get::all_store_fuel_detail();

		foreach ($list as $key => $value)
		{
			$store_id = $value['id'];
			$dbname   = \dash\engine\store::make_database_name($store_id);
			$fuel     = $value['fuel'];


			self::calc_products($fuel, $dbname);

			self::calc_factors($fuel, $dbname);

			\dash\db\mysql\tools\connection::close();

		}

		return true;

	}


	public static function get_all()
	{
		return \lib\db\temp_stats_monthly\get::all();

	}

	private static function clean_all()
	{
		return \lib\db\temp_stats_monthly\delete::delete_all();
	}


	private static function calc_products($_fuel, $_dbname)
	{
		$result = \lib\db\products\get::count_group_by_month_fuel($_fuel, $_dbname);

		foreach ($result as $key => $value)
		{
			if(isset($value['year_month']))
			{
				$year = substr($value['year_month'], 0, 4);
				$month = substr($value['year_month'], 5, 2);

				$check_exists = \lib\db\temp_stats_monthly\get::check_exists($year, $month);

				if(isset($check_exists['id']))
				{
					$count = floatval($value['count']);

					if(isset($check_exists['count_products']) && $check_exists['count_products'])
					{
						$count += floatval($check_exists['count_products']);
					}

					\lib\db\temp_stats_monthly\update::record(['count_products' => $count], $check_exists['id']);

				}
				else
				{
					$insert =
					[
						'year'           => $year,
						'month'          => $month,
						'count_products' => floatval($value['count']),
						'datecreated'    => date("Y-m-d H:i:s"),
					];

					\lib\db\temp_stats_monthly\insert::new_record($insert);
				}
			}
		}
	}



	private static function calc_factors($_fuel, $_dbname)
	{
		$result = \lib\db\factors\get::count_group_by_month_fuel($_fuel, $_dbname);

		foreach ($result as $key => $value)
		{
			if(isset($value['year_month']))
			{
				$year = substr($value['year_month'], 0, 4);
				$month = substr($value['year_month'], 5, 2);

				$check_exists = \lib\db\temp_stats_monthly\get::check_exists($year, $month);

				if(isset($check_exists['id']))
				{

					$update = [];

					$count = floatval($value['count']);

					if(isset($check_exists['count_factors']) && $check_exists['count_factors'])
					{
						$count += floatval($check_exists['count_factors']);
					}

					$update['count_factors'] = $count;


					$sum = floatval($value['sum']);

					if(isset($check_exists['sum_factors']) && $check_exists['sum_factors'])
					{
						$sum += floatval($check_exists['sum_factors']);
					}

					$update['sum_factors'] = $sum;

					$count_filtered = floatval($value['count_filtered']);

					if(isset($check_exists['count_factors_filtered']) && $check_exists['count_factors_filtered'])
					{
						$count_filtered += floatval($check_exists['count_factors_filtered']);
					}

					$update['count_factors_filtered'] = $count_filtered;


					$sum_filtered = floatval($value['sum_filtered']);

					if(isset($check_exists['sum_factors_filtered']) && $check_exists['sum_factors_filtered'])
					{
						$sum_filtered += floatval($check_exists['sum_factors_filtered']);
					}

					$update['sum_factors_filtered'] = $sum_filtered;


					\lib\db\temp_stats_monthly\update::record($update, $check_exists['id']);

				}
				else
				{
					$insert =
					[
						'year'                   => $year,
						'month'                  => $month,
						'count_factors'          => floatval($value['count']),
						'count_factors_filtered' => floatval($value['count_filtered']),
						'sum_factors'            => floatval($value['sum']),
						'sum_factors_filtered'   => floatval($value['sum_filtered']),
						'datecreated'            => date("Y-m-d H:i:s"),

					];

					\lib\db\temp_stats_monthly\insert::new_record($insert);
				}
			}
		}
	}



	private static function calc_store()
	{
		$result = \lib\db\store\get::count_group_by_month();

		foreach ($result as $key => $value)
		{
			if(isset($value['year_month']))
			{
				$year = substr($value['year_month'], 0, 4);
				$month = substr($value['year_month'], 5, 2);

				$check_exists = \lib\db\temp_stats_monthly\get::check_exists($year, $month);

				if(isset($check_exists['id']))
				{

				}
				else
				{
					$insert =
					[
						'year'        => $year,
						'month'       => $month,
						'count_store' => floatval($value['count']),
						'datecreated' => date("Y-m-d H:i:s"),
					];

					\lib\db\temp_stats_monthly\insert::new_record($insert);
				}
			}
		}
	}



	public static function chart_datecreated()
	{
		$result          = [];

		$result['day']   = self::chart_datecreated_day();
		$result['month'] = self::chart_datecreated_month();
		$result['year']  = self::chart_datecreated_year();

		return $result;
	}




	private static function chart_datecreated_day()
	{
		$chart = [];
		$day   = \lib\db\store\get::all_store_group_by_datecreated();

		if(!is_array($day))
		{
			$day = [];
		}

		$chart['categories'] = json_encode(array_column($day, 'myDate'));
		$chart['data']       = json_encode(array_map('intval', array_column($day, 'count')));

		return $chart;
	}


	private static function chart_datecreated_month()
	{
		$chart = [];
		$month = \lib\db\store\get::count_group_by_month();

		if(!is_array($month))
		{
			$month = [];
		}

		$chart['categories'] = json_encode(array_column($month, 'year_month'));
		$chart['data']       = json_encode(array_map('intval', array_column($month, 'count')));


		return $chart;
	}


	private static function chart_datecreated_year()
	{
		$chart = [];
		$year  = \lib\db\store\get::count_group_by_year();

		if(!is_array($year))
		{
			$year = [];
		}

		$chart['categories'] = json_encode(array_column($year, 'year'));
		$chart['data']       = json_encode(array_map('intval', array_column($year, 'count')));



		return $chart;
	}
}
?>
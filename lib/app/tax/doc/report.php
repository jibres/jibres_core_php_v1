<?php
namespace lib\app\tax\doc;


class report
{
	private static function analyze_args($_args)
	{
		$condition =
		[
			'year_id'   => 'id',
			'startdate' => 'date',
			'enddate'   => 'date',
		];

		$require = [];
		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$year_id = $data['year_id'];

		if($year_id)
		{
			$load_year = \lib\app\tax\year\get::get($year_id);
			if(!isset($load_year['id']))
			{
				$data['year_id'] = null;
			}
		}

		return $data;

	}


	public static function detail_report($_args)
	{
		$data = self::analyze_args($_args);


		$result = \lib\db\tax_document\get::detail_report($data);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $result);
		return $result;


	}


	public static function assistant_report($_args)
	{
		$data = self::analyze_args($_args);


		$result = \lib\db\tax_document\get::assistant_report($data);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $result);
		return $result;


	}


	public static function total_report($_args)
	{

		$data = self::analyze_args($_args);

		$result = \lib\db\tax_document\get::total_report($data);
		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $result);
		return $result;


	}


	public static function group_report($_args)
	{
		$data = self::analyze_args($_args);
		$result = \lib\db\tax_document\get::group_report($data);

		if(!is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $result);
		return $result;


	}

}
?>
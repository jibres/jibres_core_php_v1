<?php
namespace lib\app\tax\doc;


class check
{

	public static function variable($_args, $_option = [])
	{
		$condition =
		[
			'number'  => 'bigint',
			'desc'    => 'string_300',
			'date'    => 'date',
			'year_id' => 'id',
		];

		$require = ['number', 'date', 'year_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(($data['year_id'] && $data['date']) || (isset($_option['year_id']) && $data['date']))
		{
			$year_id = $data['year_id'] ? $data['year_id'] : \dash\get::index($_option, 'year_id');

			$load_year = \lib\app\tax\year\get::get($year_id);
			if(!isset($load_year['id']) || !isset($load_year['startdate']) || !isset($load_year['enddate']))
			{
				\dash\notif::error(T_("Invalid year"));
				return false;
			}

			$startdate = new \DateTime($load_year['startdate']);
			$enddate   = new \DateTime($load_year['enddate']);
			$date      = new \DateTime($data['date']);


			if($date > $enddate || $date < $startdate)
			{
				\dash\notif::error(T_("Accounting document date is not in Accounting year date!"), ['element' => ['date', 'year_id']]);
				return false;
			}

		}

		return $data;

	}

}
?>
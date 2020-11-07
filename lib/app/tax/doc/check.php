<?php
namespace lib\app\tax\doc;


class check
{

	public static function check_doc_status($_doc_id)
	{
		$load = \lib\app\tax\doc\get::get($_doc_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		if(isset($load['status']) && $load['status'] === 'lock')
		{
			\dash\notif::error(T_("This document is locked"));
			return false;
		}
		else
		{
			return true;
		}
	}


	public static function variable($_args, $_option = [], $_id = null)
	{
		$condition =
		[
			'number'    => 'bigint',
			'subnumber' => 'int',
			'desc'      => 'string_300',
			'date'      => 'date',
			'year_id'   => 'id',
			'status'    => ['enum' => ['draft', 'temp', 'lock']],
			'type'      => ['enum' => ['normal', 'opening', 'closing']],
		];

		$require = ['number', 'date', 'year_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($_id)
		{
			$check_doc_status = self::check_doc_status($_id);
			if(!$check_doc_status)
			{
				return false;
			}

		}

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

		if($data['number'])
		{
			$check_duplicate_number = \lib\db\tax_document\get::check_duplicate_number($data['number'], $data['year_id']);
			if(isset($check_duplicate_number['id']))
			{
				if(floatval($check_duplicate_number['id']) === floatval($_id))
				{
					// nothing
				}
				else
				{
					\dash\notif::error(T_("Duplicate accounting document number"), 'number');
					return false;
				}
			}
		}

		return $data;

	}

}
?>
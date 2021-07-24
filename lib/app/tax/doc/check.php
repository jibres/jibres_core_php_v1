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
			'number'        => 'bigint',
			'subnumber'     => 'int',
			'desc'          => 'string_300',
			'date'          => 'date',
			'year_id'       => 'id',
			'status'        => ['enum' => ['draft', 'temp', 'lock']],
			'type'          => ['enum' => ['normal', 'opening', 'closing']],

			// template detail
			'template'      => ['enum' => ['cost', 'income', 'petty_cash', 'partner', 'asset', 'bank_partner']],

			'pay_from'      => 'id',
			'put_on'        => 'id',
			'bank'          => 'id',
			'partner'          => 'id',
			'petty_cash'    => 'id',

			'thirdparty'    => 'id',

			'user_id'       => 'id',

			'serialnumber'  => 'string_100',
			'total'         => 'price',
			'totaldiscount' => 'price',
			'totalvat'      => 'price',
		];

		$require = ['number', 'date', 'year_id'];

		if(isset($_option['template_mode']) && $_option['template_mode'])
		{
			array_push($require, 'template');
			array_push($require, 'total');
		}

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
			$year_id = $data['year_id'] ? $data['year_id'] : a($_option, 'year_id');

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
			$my_year_id = null;
			if($data['year_id'])
			{
				$my_year_id = $data['year_id'];
			}
			elseif(isset($year_id) && $year_id)
			{
				$my_year_id = $year_id;
			}

			if($my_year_id)
			{
				$check_duplicate_number = \lib\db\tax_document\get::check_duplicate_number($data['number'], $my_year_id);
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
		}

		if(isset($_option['template_mode']) && $_option['template_mode'])
		{
			if(in_array($data['template'], ['cost', 'income']))
			{
				if(!$data['pay_from'] && !$data['thirdparty'])
				{
					\dash\notif::error(T_("Pay from or thirdparty is required"));
					return false;
				}
			}
			elseif($data['template'] === 'petty_cash')
			{
				if(!$data['bank'] || !$data['petty_cash'])
				{
					\dash\notif::error(T_("Bank and petty cash is required"));
					return false;
				}
			}
			elseif($data['template'] === 'bank_partner')
			{
				// check some error
			}

			if($data['totalvat'] && $data['total'])
			{
				$total         = floatval($data['total']);
				$totalvat      = floatval($data['totalvat']);
				$totaldiscount = floatval($data['totaldiscount']);

				$real_vat = ($total - $totaldiscount) * 0.09;

				if($totalvat != $real_vat)
				{
					$totalincludevat            = ($totalvat / 9) * 100;
					$totalnotincludevat         = $total - $totaldiscount - $totalincludevat;

					if($totalnotincludevat < 0)
					{
						\dash\notif::error(T_("Vat larger than price!"));
						return false;
					}
					$data['totalincludevat']    = $totalincludevat;
					$data['totalnotincludevat'] = $totalnotincludevat;
				}
			}
		}
		else
		{
			// in normal mode needless to this variable
			unset($data['template']);
			unset($data['pay_from']);
			unset($data['put_on']);
			unset($data['serialnumber']);
			unset($data['total']);
			unset($data['totaldiscount']);
			unset($data['totalvat']);
			unset($data['user_id']);
			unset($data['thirdparty']);
			unset($data['partner']);
			unset($data['bank']);
			unset($data['petty_cash']);
		}


		return $data;

	}

}
?>
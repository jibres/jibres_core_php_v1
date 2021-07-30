<?php
namespace lib\app\tax\doc\report;


class quarter
{
	public static function get($_args)
	{
		$condition =
		[
			'type'   => ['enum' => \lib\app\tax\doc\ready::factor_template_list()],
			'detail' => 'bit',
			'merge' => 'bit',
			'doc_id' => 'id',
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['type'])
		{
			$data['type'] = 'costasset';
		}

		$year_detail = \lib\app\tax\year\get::default_year();

		$quorumprice = floatval(a($year_detail, 'quorumprice'));

		$remainvatlastyear = floatval(a($year_detail, 'remainvatlastyear'));

		$vatsetting = a($year_detail, 'vatsetting');

		if(!is_array($vatsetting))
		{
			$vatsetting = [];
		}

		$startdate = a($year_detail, 'startdate');
		$enddate   = a($year_detail, 'enddate');

		$myYear = \dash\utility\convert::to_en_number(\dash\fit::date(date("Y-m-d", strtotime($startdate))));
		$myYear = substr($myYear, 0, 4);

		$quarter = [];

		$quarter[1] = ["$myYear-01-01", "$myYear-03-31"];
		$quarter[2] = ["$myYear-04-01", "$myYear-06-31"];
		$quarter[3] = ["$myYear-07-01", "$myYear-09-30"];
		$quarter[4] = ["$myYear-10-01", "$myYear-12-30"];

		$args = [];

		if($data['detail'])
		{
			// show the list
		}
		else
		{
			$args['summary_mode'] = true;
		}

		$args['quarterlyreport'] = 'yes';
		$args['status'] = 'lock';
		$args['pagination'] = 'n';
		$args['doc_id'] = $data['doc_id'];

		$result = [];
		foreach ($quarter as $key => $value)
		{
			$temp              = [];
			$temp['quarter']   = $key;

			$temp['startdate'] = $args['startdate'] = $value[0];
			$temp['enddate']   = $args['enddate']   = $value[1];

			$args['template']  = $data['type'];

			$list = \lib\app\tax\doc\search::list(null, $args);

			if(!is_array($list))
			{
				$list = [];
			}



			if($data['merge'])
			{
				$new_list = [];
				foreach ($list as $k => $v)
				{
					if(floatval($v['total']) < floatval($quorumprice))
					{
						if(!isset($new_list['merged']))
						{
							$new_list['merged'] =
							[
								'merged'             => true,
								'desc_merge'         => null,
								'id'                 => null,
								'number'             => null,
								'date'               => null,
								'desc'               => null,
								'tstatus'            => null,
								'status'             => null,
								'datecreated'        => null,
								'datemodified'       => null,
								'year_id'            => null,
								'gallery'            => null,
								'subnumber'          => null,
								'template_title'     => null,
								'template'           => null,
								'serialnumber'       => null,
								'total'              => null,
								'totaldiscount'      => null,
								'totalvat'           => null,
								'user_id'            => null,
								'producttitle'       => null,
								'totalnotincludevat' => null,
								'totalincludevat'    => null,
								'sum_debtor'         => null,
								'sum_creditor'       => null,
								'item_count'         => null,
							];
						}

						$new_list['merged'] = array_merge($new_list['merged'],
						[
							'merged'             => true,
							'desc'               => T_("Merged document"),
							'desc_merge'         => $new_list['merged']['desc_merge']. ', '. $v['desc'],
							'total'              => floatval($new_list['merged']['total']) + floatval($v['total']),
							'totaldiscount'      => floatval($new_list['merged']['totaldiscount']) + floatval($v['totaldiscount']),
							'totalvat'           => floatval($new_list['merged']['totalvat']) + floatval($v['totalvat']),
							'totalnotincludevat' => floatval($new_list['merged']['totalnotincludevat']) + floatval($v['totalnotincludevat']),
							'totalincludevat'    => floatval($new_list['merged']['totalincludevat']) + floatval($v['totalincludevat']),
						]);
					}
					else
					{
						$new_list[] = $v;
					}
					$list = $new_list;
				}

			}

			if($data['detail'])
			{
				self::fill_customer_detail($list, $data);

				foreach ($list as $k => $v)
				{
					if(a($v, 'totalincludevat'))
					{
						$list[$k]['totalvat6'] = round((floatval($v['totalvat'])  / 9) * 6);
						$list[$k]['totalvat3'] = round((floatval($v['totalvat']) / 9) * 3);
					}
				}
			}

			$result[$key] = $list;

			if(!$data['detail'])
			{
				$result[$key]['title'] = \lib\app\tax\doc\ready::factor_type_translate($data['type']). ' '. T_("Quarter"). ' '. \dash\fit::number($key);
			}
		}

		return $result;
	}


	private static function fill_customer_detail(&$list, $data)
	{
		$all_doc_id = array_column($list, 'id');
		$all_doc_id = array_filter($all_doc_id);
		$all_doc_id = array_unique($all_doc_id);

		if(!$all_doc_id)
		{
			return;
		}

		$get_all_user_accounting_detail = \lib\db\tax_docdetail\get::user_accounting_detail_from_doc_ids(implode(',', $all_doc_id));

		if(!is_array($get_all_user_accounting_detail))
		{
			$get_all_user_accounting_detail = [];
		}

		$user_detail = [];

		foreach ($get_all_user_accounting_detail as $key => $value)
		{
			if(!isset($user_detail[$value['tax_document_id']]))
			{
				$user_detail[$value['tax_document_id']] = $value;
			}
		}

		foreach ($list as $key => $value)
		{
			if(isset($user_detail[$value['id']]))
			{
				$list[$key]['user_detail'] = a($user_detail,$value['id']);
				if($data['doc_id'])
				{
					$user_id = a($user_detail, $value['id'], 'id');
					if($user_id)
					{
						$load_primary_address = \dash\db\address::get_primary_user_address($user_id);
						if($load_primary_address)
						{
							$load_primary_address = \dash\app\address::ready($load_primary_address);
							$list[$key]['address_detail'] = $load_primary_address;
						}
					}
				}
			}
		}
	}
}
?>
<?php
namespace lib\app\tax\doc;


class closing
{
	public static function list_harmful_profit($_year_id)
	{

		$args              = [];
		$args['year_id']   = $_year_id;

		$report = \lib\app\tax\doc\report::detail_report($args);

		if(isset($report['list']) && is_array($report['list']))
		{
			/*nothing*/
		}
		else
		{
			return false;
		}

		$group_list = \lib\app\tax\coding\get::list_of('group');
		$harmful_profit_group = array_column($group_list, 'naturegroup', 'id');


		$list = [];

		foreach ($report['list'] as $key => $value)
		{
			if(isset($value['group_id']) && isset($harmful_profit_group[$value['group_id']]) && $harmful_profit_group[$value['group_id']] === 'harmful profit')
			{
				$list[] = $value;
			}
		}

		return $list;

	}

	public static function close_harmful_profit($_year_id)
	{
		$list = self::list_harmful_profit($_year_id);
		if(!$list)
		{
			\dash\notif::error(T_("No Document to close!"));
			return false;
		}

		$load_year = \lib\app\tax\year\get::get($_year_id);
		if(!isset($load_year['title']))
		{
			\dash\notif::error(T_("Invalid year"));
			return false;
		}

		$closing = self::get_closing($load_year);


		// if(isset($closing['close_harmful_profit']))
		// {
		// 	\dash\notif::error(T_("Document already closed in harmful-profit level"));
		// 	return false;
		// }

		$accounting_setting = \lib\app\setting\get::accounting_setting();

		$assistant_close_harmful_profit = null;
		if(isset($accounting_setting['assistant_close_harmful_profit']) && $accounting_setting['assistant_close_harmful_profit'])
		{
			$assistant_close_harmful_profit =  $accounting_setting['assistant_close_harmful_profit'];
		}
		else
		{
			$assistant_close_harmful_profit = \lib\db\tax_coding\get::id_by_code(3803);
		}

		if(!$assistant_close_harmful_profit)
		{
			\dash\notif::error(T_("Please set accounting setting assistant closing harmful-profit detail id to continue"));
			return false;
		}

		$doc_number = \lib\app\tax\doc\get::new_doc_number();

		$post =
		[
			'number'    => $doc_number,
			'subnumber' => 999990,
			'year_id'   => $_year_id,
			'desc'      => T_("Close accounting harmful-profit for :year", ['year' => $load_year['title']]),
			'date'      => $load_year['enddate'], // end of year
			'type'      => 'normal', // closing - opening
		];

		$result = \lib\app\tax\doc\add::add($post);

		if(!isset($result['id']))
		{
			\dash\notif::error(T_("Can not add accounting document"));
			return false;
		}

		$end_value = 0;

		foreach ($list as $key => $value)
		{
			$type = null;
			if(isset($value['end_value']))
			{
				if($value['end_value'] < 0)
				{
					$type = 'debtor';
				}
				elseif($value['end_value'] > 0)
				{
					$type = 'creditor';
				}
			}

			$end_value += floatval($value['end_value']);

			if($type)
			{
				$post =
				[
					'tax_document_id' => $result['id'],
					'type'            => $type,
					'value'           => abs($value['end_value']),
					'desc'            => null,
					'sort'            => $key,
					'assistant_id'    => $value['assistant_id'],
					'details_title'   => $value['details_title'],
				];

				\lib\app\tax\docdetail\add::add($post);
			}
		}

		$end_type = null;
		if($end_value > 0)
		{
			$end_type = 'debtor';
		}
		elseif($end_value < 0)
		{
			$end_type = 'creditor';
		}

		if($end_type)
		{
			$post =
			[
				'tax_document_id' => $result['id'],
				'type'            => $end_type,
				'value'           => abs($end_value),
				'desc'            => null,
				'sort'            => 9999,
				'assistant_id'    => $assistant_close_harmful_profit, // get from setting,
				'details_title'   => $load_year['title'],
			];

			\lib\app\tax\docdetail\add::add($post);
		}

		$lock =
		[
			'status' => 'lock',
		];

		\lib\app\tax\doc\edit::edit_status($lock, $result['id']);

		$closing['close_harmful_profit'] =
		[
			'doc_number' => $doc_number,
			'doc_id'     => $result['id'],
			'date'       => date("Y-m-d H:i:s"),
			'end_value'  => $end_value,
			'end_type'   => $end_type,
		];

		$closing                = json_encode($closing, JSON_UNESCAPED_UNICODE);
		$update                 = [];
		$update['closing']      = $closing;
		$update['datemodified'] = date("Y-m-d H:i:s");
		\lib\db\tax_year\update::update($update, $load_year['id']);


		\dash\notif::clean();

		\dash\notif::ok(T_("Operation complete"));
	}


	private static function get_closing($_year_detail)
	{
		$closing = [];
		if(isset($_year_detail['closing']))
		{
			$closing = $_year_detail['closing'];
			$closing = json_decode($closing, true);

			if(!is_array($closing))
			{
				$closing = [];
			}
		}

		return $closing;
	}


	public static function close_accumulated($_year_id)
	{
		$list = self::list_harmful_profit($_year_id);
		if(!$list)
		{
			\dash\notif::error(T_("No Document to close!"));
			return false;
		}

		$accounting_setting = \lib\app\setting\get::accounting_setting();

		$assistant_close_harmful_profit = null;
		if(isset($accounting_setting['assistant_close_harmful_profit']) && $accounting_setting['assistant_close_harmful_profit'])
		{
			$assistant_close_harmful_profit =  $accounting_setting['assistant_close_harmful_profit'];
		}
		else
		{
			$assistant_close_harmful_profit = \lib\db\tax_coding\get::id_by_code(3803);
		}

		$assistant_close_accumulated    = null;

		if(isset($accounting_setting['assistant_close_accumulated']) && $accounting_setting['assistant_close_accumulated'])
		{
		 	$assistant_close_accumulated   = $accounting_setting['assistant_close_accumulated'];
		}
		else
		{
			$assistant_close_accumulated = \lib\db\tax_coding\get::id_by_code(3701);
		}


		if(!$assistant_close_harmful_profit)
		{
			\dash\notif::error(T_("Please set accounting setting assistant closing harmful-profit detail id to continue"));
			return false;
		}

		if(!$assistant_close_accumulated)
		{
			\dash\notif::error(T_("Please set accounting setting assistant accumulated detail id to continue"));
			return false;
		}

		$load_year = \lib\app\tax\year\get::get($_year_id);
		if(!isset($load_year['title']))
		{
			\dash\notif::error(T_("Invalid year"));
			return false;
		}


		$closing = self::get_closing($load_year);


		if(!isset($closing['close_harmful_profit']))
		{
			\dash\notif::error(T_("Please close harmful-profit document first"));
			return false;
		}

		// if(isset($closing['close_accumulated']))
		// {
		// 	\dash\notif::error(T_("accumulated document already sent"));
		// 	return false;
		// }


		if(isset($closing['close_harmful_profit']['end_value']) && $closing['close_harmful_profit']['end_value'] && isset($closing['close_harmful_profit']['end_type']) && $closing['close_harmful_profit']['end_type'])
		{
			// nothing
		}
		else
		{
			\dash\notif::warn(T_("Needless to create document close accumulated"));
			return false;
		}

		$doc_number = \lib\app\tax\doc\get::new_doc_number();

		$post =
		[
			'number'    => $doc_number,
			'subnumber' => 999991,
			'year_id'   => $_year_id,
			'desc'      => T_("Move accounting harmful-profit for :year to accumulated", ['year' => $load_year['title']]),
			'date'      => $load_year['enddate'], // end of year
			'type'      => 'normal', // closing - opening
		];

		$result = \lib\app\tax\doc\add::add($post);

		if(!isset($result['id']))
		{
			\dash\notif::error(T_("Can not add accounting document"));
			return false;
		}

		$end_value = $closing['close_harmful_profit']['end_value'];

		$post =
		[
			'tax_document_id' => $result['id'],
			'type'            => 'debtor',
			'value'           => abs($end_value),
			'desc'            => null,
			'sort'            => 1,
			'assistant_id'    => $assistant_close_harmful_profit, // get from setting,
			'details_title'   => $load_year['title'],
		];

		\lib\app\tax\docdetail\add::add($post);

		$post =
		[
			'tax_document_id' => $result['id'],
			'type'            => 'creditor',
			'value'           => abs($end_value),
			'desc'            => null,
			'sort'            => 1,
			'assistant_id'    => $assistant_close_accumulated, // get from setting,
			'details_title'   => $load_year['title'],
		];

		\lib\app\tax\docdetail\add::add($post);

		$lock =
		[
			'status' => 'lock',
		];
		\lib\app\tax\doc\edit::edit_status($lock, $result['id']);

		$closing['close_accumulated'] =
		[
			'doc_number' => $doc_number,
			'doc_id'     => $result['id'],
			'date'       => date("Y-m-d H:i:s"),
		];

		$closing                = json_encode($closing, JSON_UNESCAPED_UNICODE);
		$update                 = [];
		$update['closing']      = $closing;
		$update['datemodified'] = date("Y-m-d H:i:s");
		\lib\db\tax_year\update::update($update, $load_year['id']);


		\dash\notif::clean();

		\dash\notif::ok(T_("Operation complete"));
	}


	public static function closing_list($_year_id)
	{
		$args              = [];
		$args['year_id']   = $_year_id;

		$report = \lib\app\tax\doc\report::detail_report($args);

		if(isset($report['list']) && is_array($report['list']))
		{
			/*nothing*/
		}
		else
		{
			return false;
		}

		$group_list = \lib\app\tax\coding\get::list_of('group');
		$harmful_profit_group = array_column($group_list, 'naturegroup', 'id');


		$list = [];

		foreach ($report['list'] as $key => $value)
		{
			if(isset($value['group_id']) && isset($harmful_profit_group[$value['group_id']]) && $harmful_profit_group[$value['group_id']] !== 'harmful profit')
			{
				$list[] = $value;
			}
		}

		return $list;
	}

	public static function closing($_year_id)
	{

		$list = self::closing_list($_year_id);
		if(!$list)
		{
			\dash\notif::error(T_("No Document to close!"));
			return false;
		}

		$load_year = \lib\app\tax\year\get::get($_year_id);
		if(!isset($load_year['title']))
		{
			\dash\notif::error(T_("Invalid year"));
			return false;
		}

		$closing = self::get_closing($load_year);


		$accounting_setting = \lib\app\setting\get::accounting_setting();

		$assistant_closing              = null;

		if(isset($accounting_setting['assistant_closing']) && $accounting_setting['assistant_closing'])
		{
			$assistant_closing = $accounting_setting['assistant_closing'];
		}
		else
		{
			$assistant_closing = \lib\db\tax_coding\get::id_by_code(1901);
		}
		if(!$assistant_closing)
		{
			\dash\notif::error(T_("Please set accounting setting assistant closing detail id to continue"));
			return false;
		}

		$doc_number = \lib\app\tax\doc\get::new_doc_number();

		$post =
		[
			'number'    => $doc_number,
			'subnumber' => 999992,
			'year_id'   => $_year_id,
			'desc'      => T_("Closing document :year", ['year' => $load_year['title']]),
			'date'      => $load_year['enddate'], // end of year
			'type'      => 'normal', // closing - opening
		];

		$result = \lib\app\tax\doc\add::add($post);

		if(!isset($result['id']))
		{
			\dash\notif::error(T_("Can not add accounting document"));
			return false;
		}

		$end_value = 0;

		foreach ($list as $key => $value)
		{
			$type = null;
			if(isset($value['end_value']))
			{
				if($value['end_value'] < 0)
				{
					$type = 'debtor';
				}
				elseif($value['end_value'] > 0)
				{
					$type = 'creditor';
				}
			}

			$end_value += floatval($value['end_value']);

			if($type)
			{
				$post =
				[
					'tax_document_id' => $result['id'],
					'type'            => $type,
					'value'           => abs($value['end_value']),
					'desc'            => null,
					'sort'            => $key,
					'assistant_id'    => $value['assistant_id'],
					'details_title'   => $value['details_title'],
				];

				\lib\app\tax\docdetail\add::add($post);
			}
		}

		$end_type = null;
		if($end_value > 0)
		{
			$end_type = 'debtor';
		}
		elseif($end_value < 0)
		{
			$end_type = 'creditor';
		}

		if($end_type)
		{
			$post =
			[
				'tax_document_id' => $result['id'],
				'type'            => $end_type,
				'value'           => abs($end_value),
				'desc'            => null,
				'sort'            => 9999,
				'assistant_id'    => $assistant_closing, // get from setting,
				'details_title'   => $load_year['title'],
			];

			\lib\app\tax\docdetail\add::add($post);
		}

		$lock =
		[
			'status' => 'lock',
		];

		\lib\app\tax\doc\edit::edit_status($lock, $result['id']);

		$closing['closing'] =
		[
			'doc_number' => $doc_number,
			'doc_id'     => $result['id'],
			'date'       => date("Y-m-d H:i:s"),
			'end_value'  => $end_value,
			'end_type'   => $end_type,
		];

		$closing                = json_encode($closing, JSON_UNESCAPED_UNICODE);
		$update                 = [];
		$update['closing']      = $closing;
		$update['datemodified'] = date("Y-m-d H:i:s");
		\lib\db\tax_year\update::update($update, $load_year['id']);


		\dash\notif::clean();

		\dash\notif::ok(T_("Year closing complete"));
	}


	public static function opening($_year_id)
	{

		$load_opening_doc = \lib\app\tax\doc\get::opening_doc($_year_id);

		if($load_opening_doc)
		{
			\dash\notif::error(T_("The opening document already added"));
			return false;
		}

		$year_id = \dash\validate::id($_year_id);

		$get_last_year = \lib\db\tax_year\get::last_year($year_id);

		if(!$get_last_year)
		{
			\dash\notif::error(T_("Can not find last year!"));
			return false;
		}

		$load_year = \lib\app\tax\year\get::get($_year_id);
		if(!isset($load_year['title']))
		{
			\dash\notif::error(T_("Invalid year"));
			return false;
		}


		$closing = self::get_closing($get_last_year);

		if(!isset($closing['closing']) || !isset($closing['closing']['doc_id']))
		{
			\dash\notif::error(T_("Can not find last year closing document"));
			return false;
		}

		$doc_id = $closing['closing']['doc_id'];
		$load_doc = \lib\app\tax\docdetail\get::list($doc_id);


		if(!$load_doc || !is_array($load_doc))
		{
			\dash\notif::error(T_("Can not find last year closing document"));
			return false;
		}


		$post =
		[
			'number'    => 1,
			'subnumber' => 1,
			'year_id'   => $year_id,
			'desc'      => T_("Opening document :year", ['year' => $load_year['title']]),
			'date'      => $load_year['startdate'], // start of year
			'type'      => 'opening', // closing - opening
		];

		$result = \lib\app\tax\doc\add::add($post);

		if(!isset($result['id']))
		{
			\dash\notif::error(T_("Can not add accounting document"));
			return false;
		}


		foreach ($load_doc as $key => $value)
		{
			if($value['type'] === 'creditor')
			{
				$type = 'debtor';
			}
			else
			{
				$type = 'creditor';
			}

			$post =
			[
				'tax_document_id' => $result['id'],
				'type'            => $type,
				'value'           => abs($value['value']),
				'desc'            => null,
				'sort'            => $key,
				'assistant_id'    => $value['assistant_id'],
				'details_title'   => $value['details_title'],
			];

			\lib\app\tax\docdetail\add::add($post);

		}


		$lock =
		[
			'status' => 'lock',
		];

		\lib\app\tax\doc\edit::edit_status($lock, $result['id']);

		$opening = [];
		$opening['opening'] =
		[
			'doc_number' => 1,
			'doc_id'     => $result['id'],
			'date'       => date("Y-m-d H:i:s"),
		];

		$opening                = json_encode($opening, JSON_UNESCAPED_UNICODE);
		$update                 = [];
		$update['opening']      = $opening;
		$update['datemodified'] = date("Y-m-d H:i:s");
		\lib\db\tax_year\update::update($update, $year_id);


		\dash\notif::clean();

		\dash\notif::ok(T_("Year opening complete"));
	}

}
?>
